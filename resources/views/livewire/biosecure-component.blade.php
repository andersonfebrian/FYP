<div class="container mt-2">
    <div class="d-flex justify-content-center">
        <h3>Face Recognition</h3>
    </div>
    <div class="d-flex justify-content-center">
        <video autoplay id="video_element"></video>
        <canvas class="d-none"></canvas>
    </div>
    <div class="d-flex justify-content-center mt-2">
        <button wire:click="$emit('start')" class="btn btn-secondary">Start</button>
    </div>

    <script>
        // Not Ideal, but ok
        let vStream;

        let data = [];

        let params = {
            audio: false,
            video: {
                width: 800,
                height: 600,
            }
        };

        let video = document.querySelector('#video_element');
        let canvas = document.querySelector('canvas');

        canvas.width = 800;
        canvas.height = 600;

        function captureFrame() {

            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;

            canvas.getContext('2d').drawImage(video, 0, 0, video.videoWidth, video.videoHeight, 0, 0, canvas.width, canvas
                .height);
            let img = canvas.toDataURL("image/png");
            return img;
        }

        function initDevice(params) {
            navigator.mediaDevices.getUserMedia(params).then((stream) => {
                video.srcObject = vStream = stream;
                if (stream.active) {
                    let i = 1;
                    const sendFrame = setInterval(() => {
                        axios.post(route('browser.api.biosecure.store-frame'), {
                            'base64_str': captureFrame(),
                            'user': @this.user,
                            'email': @this.email,
                        }).then((res) => i++).catch((err) => clearInterval(sendFrame));

                        if (i >= @this.frame_count) {
                            clearInterval(sendFrame);
                            setTimeout(() => {
                                axios.post(route('browser.api.biosecure.image-processing'), {
                                    'user': @this.user,
                                    'email': @this.email,
                                    'from': @this.from
                                }).then(res => {
                                    if (res.status == 201 && @this.from == "register") {
                                        window.livewire.emit("registered");
                                    }

                                    if (res.status == 200 && @this.from == "login") {
                                        window.livewire.emit('login');
                                    }

                                    if (res.status == 200 && @this.from ==
                                        "forget-password") {
                                        window.livewire.emitTo('forget-password-component',
                                            'changeState', 'reset_password');
                                    }
                                }).catch((err) => Swal.fire({
									toast:true,
									title: 'Failed Verification.',
									text: 'Our system failed to verify your identity. Please try again using the button below. If error persists, contact customer support.',
									confirmButtonColor: "#00802b",
                                }));
                                window.livewire.emit('stop');
                                Swal.fire({
									//TODO:
                                    title: "Training our AI model. Please wait..."
                                });
                            }, 1500);
                        }

                    }, 200);
                }
            }).catch(err => console.log('unable to store image to server'));
        }

        async function getInputDevices() {
            const devices = await navigator.mediaDevices.enumerateDevices();
            return devices;
        }

        function changeInputDevice(deviceId) {
            params['video']['deviceId'] = deviceId;
            initDevice(params);
        }

        window.livewire.on('start', () => {
            initDevice(params);
        });

        window.livewire.on('stop', () => {
            vStream.getTracks().forEach((track) => {
                track.stop();
            });
        });

        window.livewire.on('changeInputDevice', () => {
            changeInputDevice(deviceId);
        });

        window.livewire.on('getInputDevices', () => {
            getInputDevices().then(res => {
                let videoInputDevices = [];
                let inputDevicesDOM = document.querySelector('#input_devices');

                inputDevicesDOM.innerHTML = '';

                res.forEach((el, key) => {
                    if (el['kind'] == 'videoinput' && el['deviceId'] != '') {
                        let li = document.createElement('li');
                        li.innerHTML = `${el['deviceId']}`;
                        inputDevicesDOM.appendChild(li);
                    }
                });
            }).catch((err) => console.log(err));
        });

        $('document').ready(function() {
            Swal.fire({
                icon: "warning",
                title: "Get Ready!",
                text: "We will be capturing your facial features! Make sure you are in the frame!",
                confirmButtonText: "Ready!",
                confirmButtonColor: "green",
                showCancelButton: true,
                cancelButtonColor: "gray",
                cancelButtonText: "Not Ready",
                reverseButtons: true,
                allowOutsideClick: false,
                allowEnterKey: false,
                allowEscapeKey: false
            }).then((res) => {
                console.log(res);
                if (res.value) {
                    initDevice(params);
                } else {
                    console.log("user is not ready!");
                    Swal.fire({
                        text: "You can start the camera by clicking the Start button below!"
                    });
                }
            });
        });
    </script>
</div>
