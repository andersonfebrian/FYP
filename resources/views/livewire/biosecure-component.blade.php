<div>
	{{ $user['first_name'] }}
	<div class="d-flex justify-content-center">
		<h3>Face Recognition</h3>
	</div>
	<div class="d-flex justify-content-center">
		<video autoplay id="video_element"></video>
		<canvas class="d-none"></canvas>
	</div>
	<div class="d-flex inline-block mt-2">
		<p>Select Input Device</p>
		<div id="input_devices"></div>
		<p class="d-none" style="color:red;">It looks like you do not have an input device or you have not allowed access to input device, please check and refresh page</p>
	</div>
	<button wire:click="$emit('getInputDevices')"><i class="far fa-redo"></i></button>
	<button wire:click="$emit('start')">Start</button>
	<button wire:click="$emit('stop')">Stop</button>

	<script>
		// TODO: stop video playback when back button is pressed
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

			canvas.getContext('2d').drawImage(video, 0, 0, video.videoWidth, video.videoHeight, 0, 0, canvas.width, canvas.height);
			let img = canvas.toDataURL("image/png");
			return img;
		}

		function initDevice(params) {
			navigator.mediaDevices.getUserMedia(params).then((stream) => {
				video.srcObject = vStream = stream;
				if(stream.active) {
					// send image here
					let i = 1;
					const sendFrame = setInterval(() => {
						axios.post(route('browser.api.biosecure.store-frame'), {
							'base64_str' : captureFrame(),
							'user': @this.user,
							'email': @this.email,
						}).then((res) => {
							console.log(res);
							i++;
						}).catch(err => console.log(err));

						if(i == 5) {
							clearInterval(sendFrame);
							setTimeout(()=>{
								axios.post(route('browser.api.biosecure.image-processing'), {
									'user': @this.user,
									'email': @this.email
								}).then(res => {

								}).catch(err => console.log(err));
							}, 1500);
							console.log('break from capturing frame');
						}

					}, 1500);
				}
			}).catch(err => console.log(err));
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
			console.log('stop');
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
					if(el['kind'] == 'videoinput' && el['deviceId'] != '') {
						let li = document.createElement('li');
						li.innerHTML = `${el['deviceId']}`;
						inputDevicesDOM.appendChild(li);
					}
				});
			}).catch((err) => console.log(err));
		});

		$('document').ready(function() {
			// initDevice(params);
			// getInputDevices().then(res => console.log(res));
			window.livewire.emit('getInputDevices');
		});
	</script>
</div>