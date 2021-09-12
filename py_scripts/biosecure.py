import os
import sys
import cv2 as cv
import numpy as np
import glob

def convertToGrayscale(image):
    return cv.cvtColor(image, cv.COLOR_BGR2GRAY)

# Returns the image with bounding box around the face if found, and return number of faces found
'''
    1. image passed to face detection function
    2. face detected ? save to processed folder and remove from user root folder : remove from user root folder
    3. pass processed image to facial recognition
'''
def face_detection(img_path, cascade, scaleFactor=1.1):
    src = cv.imread(img_path)

    gray = convertToGrayscale(src)

    faces = cascade.detectMultiScale(gray, scaleFactor=scaleFactor, minNeighbors=5)

    print(faces)

    if len(faces) > 0:
        for(x, y, w, h) in faces:
            cv.rectangle(src, (x, y), (x+w, y+h), (0, 255, 0), 1)

        try:
            if not os.path.exists(sys.argv[3] + "\processed"):
                os.makedirs(os.path.abspath(sys.argv[3] + "\processed"))

            cv.imwrite(sys.argv[3] + '\processed\\' + os.path.basename(img_path), src)

            print("face found and processed")

            os.remove(img_path)

        except Exception as e:
            print(e)
            
    else:
       print("face not found, remove")
       os.remove(img_path)

    return src, len(faces)

def haar_cascade():
    return cv.CascadeClassifier(os.path.abspath(sys.argv[2] + '\\py_scripts\\haarcascade_frontalface_default.xml'))

def raw_frames():
    if(os.getcwd() != sys.argv[3]):
        os.chdir(sys.argv[3])

    image = []

    for item in os.listdir(sys.argv[3]):
        if(item.endswith(('.jpg', '.png')) and os.path.isfile(item)):
            image.append(item)
            
    return image

def main():
    try:
        images = raw_frames()

        for (index, img_path) in enumerate(images):

            face, count = face_detection(os.path.abspath(img_path), haar_cascade())

            #print(img_path, index, f"face count-{count}")


    except:
        pass


if __name__ == "__main__":
    main()
