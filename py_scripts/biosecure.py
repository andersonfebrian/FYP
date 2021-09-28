import os
import sys
import cv2 as cv
import numpy as np
import shutil

HAAR_FRONTALFACE = 0
HAAR_EYE = 1
HAAR_EYE_GLASSES = 2

def convertToGrayscale(image):
    return cv.cvtColor(image, cv.COLOR_BGR2GRAY)

def is_grayscale(image_src):
    return True if len(image_src.shape) == 1 else False

def detection(img_src, cascade, scale_factor = 1.1, min_neighbor = 5):
    """@param img_src Path to the image \n @param cascade The loaded cascade type from haar_cascade() \n @param scale_factor \n @returns src Loaded Image from cv.imread() \n @returns detected_region [Tuple] Region Of Interest \n @returns img_path"""
    try:
        if isinstance(img_src, str):
            src = cv.imread(img_src)
        else:
            src = img_src
    except:
        pass

    gray = convertToGrayscale(src)

    detected_region = cascade.detectMultiScale(gray, scaleFactor = scale_factor, minNeighbors = min_neighbor)

    return src, detected_region

def draw_bounding_box(img_src, roi, color = (0, 255, 0), thickness = 1):
    """@param img_src \n @param roi \n @param color \n @param thickness \n @return image"""
    image = img_src.copy()

    for (x, y, w, h) in roi:
        cv.rectangle(image, (x, y), (x+w, y+h), color = color, thickness = thickness)

    return image

def face_alignment(img_src):

    image_copy = img_src.copy()

    _, eye_roi = detection(image_copy, haar_cascade(cascade=HAAR_EYE_GLASSES))

    eyes = eye_roi[:2]

    if eyes[0][0] < eyes[1][0]:
        left_eye, right_eye = eyes
    else:
        right_eye, left_eye = eyes

    left_eye_center = ( int(left_eye[0] + (left_eye[2]/2)), int(left_eye[1] + (left_eye[3]/2)) )
    left_x, left_y = left_eye_center
    right_eye_center = ( int(right_eye[0] + (right_eye[2]/2)), int(right_eye[1] + (right_eye[3]/2)) )
    right_x, right_y = right_eye_center

    if left_y > right_y:
        point = (right_x, left_y)
        direction = -1
    else:
        point = (left_x, right_y)
        direction = 1

    delta_x = right_x - left_x
    delta_y = right_y - left_y
    angle = np.arctan(delta_y/delta_x)
    angle = (angle * 180) / np.pi

    h, w = image_copy.shape[:2]

    center = (w//2, h//2)

    m = cv.getRotationMatrix2D(center, angle, 1.0)
    aligned = cv.warpAffine(image_copy, m, (w,h))

    return aligned, eyes

def haar_cascade(cascade = HAAR_FRONTALFACE):
    if(cascade == 0):
        file = "haarcascade_frontalface_default.xml"

    if(cascade == 1):
        file = "haarcascade_eye.xml"
    
    if cascade == 2:
        file = "haarcascade_eye_tree_eyeglasses.xml"

    # if len(sys.argv) > 1 temp fix for both use in local and api calls
    return cv.CascadeClassifier(os.path.abspath(sys.argv[2] + '\\py_scripts\\' + f"{file}")) if (len(sys.argv) > 1) else cv.CascadeClassifier(os.path.abspath(file))

def raw_frames():
    if(os.getcwd() != sys.argv[3]):
        os.chdir(sys.argv[3])

    image = []

    for item in os.listdir(sys.argv[3]):
        if(item.endswith(('.jpg', '.png')) and os.path.isfile(item)):
            image.append(item)
            
    return image

def split():
    images = raw_frames()
    testing = images[:25]
    training = images[25:]
    return testing, training

def remove_raw_frame(file:str):
    os.remove(file)
    return True if os.path.exists(file) else False

def process_raw_data(raw_image_data:list, processed_folder = "training"):

    if not os.path.exists(os.path.join(sys.argv[3], f"{processed_folder}")):
        os.mkdir(os.path.join(sys.argv[3], f"{processed_folder}"))

    for index, image in enumerate(raw_image_data):
        img = cv.imread(image)
        try:

            img_copy = img.copy()

            _, face_org_roi = detection(img_copy, haar_cascade())

            aligned, eyes_roi = face_alignment(img)

            aligned, face_roi = detection(aligned, haar_cascade())

            if len(eyes_roi) == 2 and len(face_roi) == 1: 
                # aligned = draw_bounding_box(aligned, eyes_roi)
                # aligned = draw_bounding_box(aligned, face_roi)

                x, y, w, h = face_roi[0]
                x2, y2, w2, h2 = face_roi[0]

                aligned_cropped = aligned[y:y+h, x:x+w]
                original_cropped = img_copy[y2:y2+h2, x2:x2+w2]

                #concat_hor = np.concatenate((original_cropped, aligned_cropped), axis=1)

                cv.imwrite(os.path.join(sys.argv[3] + f"\\{processed_folder}\\", os.path.basename(image)), aligned_cropped)

                #cv.imshow(f"{index}", concat_hor)

                remove_raw_frame(image)
            else:
                flag = remove_raw_frame(image)
        except Exception as e:
            flag = remove_raw_frame(image)

def load_training_data():
    """Returns list of training images using the cv.imread() function"""
    loaded_data = []
    labels = []

    if os.getcwd() != (sys.argv[3] + "\\training"):
        os.chdir(sys.argv[3] + "\\training")

    for index, image in enumerate(os.listdir(sys.argv[3] + "\\training\\")):
        img = cv.imread(os.path.join(sys.argv[3] + "\\training\\", image), cv.IMREAD_GRAYSCALE)
        loaded_data.append(img)
        labels.append(1)

    return loaded_data, labels

def load_testing_data(as_grayscale = False):

    loaded_data = []
    image_paths = []

    if os.getcwd() != (sys.argv[3] + "\\testing"):
        os.chdir(sys.argv[3] + "\\testing")

    for index, image in enumerate(os.listdir(sys.argv[3] + "\\testing\\")):
        img = cv.imread(os.path.join(sys.argv[3] + "\\testing\\", image), cv.IMREAD_GRAYSCALE) if as_grayscale == True else cv.imread(os.path.join(sys.argv[3] + "\\testing\\", image))
        loaded_data.append(img)
        image_paths.append(os.path.join(sys.argv[3] + "\\testing\\", image))

    return loaded_data, image_paths

def move_to_training(file:str):
    shutil.move(file, sys.argv[3] + "\\training")
    pass

def train_recognizer():
    training_data, labels = load_training_data()
    face_recognizer = cv.face.LBPHFaceRecognizer_create()
    face_recognizer.train(training_data, np.array(labels))
    return face_recognizer

def predict(trained_recognizer, image_src):
    """image source passed should be of Grayscale Image"""
    if isinstance(image_src, str):
        try:
            image_src = cv.imread(image_src, cv.COLOR_BGR2GRAY)
        except Exception as e:
            pass
    
    try:
        if not is_grayscale(image_src):
            image_src = convertToGrayscale(image_src)
    except:
        pass

    label, confidence = trained_recognizer.predict(image_src)
    return label, confidence

def register():
    testing, training = split()

    process_raw_data(training)
    process_raw_data(testing, processed_folder="testing")

    face_recognizer = train_recognizer()


    testing_data, path = load_testing_data()

    # name = ["", "Anderson Febrian"]

    test_image_confidence_counter = 0

    for index, testing in enumerate(testing_data):
        try:

            label, confidence = predict(face_recognizer, testing)
            #print(f"{index} - {confidence}")

            if confidence > 20:
                remove_raw_frame(path[index])
            else:
                test_image_confidence_counter+=1
                move_to_training(path[index])
            
        except Exception as e:
            pass
    #print(test_image_confidence_counter)
    if test_image_confidence_counter >= 1:
        print('{"message":"success", "status":201}')
    else:
        print('{"message":"error", "status":400}')
    # https://docs.opencv.org/4.5.0/dd/d65/classcv_1_1face_1_1FaceRecognizer.html#ab0d593e53ebd9a0f350c989fcac7f251

def login():
    #Todo: Duplicate code
    face_recognizer = train_recognizer()

    testing, _ = split()

    process_raw_data(testing, processed_folder="testing")

    testing_data, path = load_testing_data()

    test_image_confidence_counter = 0

    for index, testing in enumerate(testing_data):
        try:

            label, confidence = predict(face_recognizer, testing)
            #print(f"{index} - {confidence}")

            if confidence > 32:
                remove_raw_frame(path[index])
            else:
                test_image_confidence_counter+=1
                move_to_training(path[index])
            
        except Exception as e:
            pass
    #print(test_image_confidence_counter)
    if test_image_confidence_counter >= 1:
        print('{"message":"success", "status":200}')
    else:
        print('{"message":"error", "status":400}')

def biosecure():
    if sys.argv[1] == "register":
        register()

    if sys.argv[1] == "login":
        login()

    if sys.argv[1] == "forget-password":
        login()

def main():
    biosecure()
    pass    

if __name__ == "__main__":
    main()
