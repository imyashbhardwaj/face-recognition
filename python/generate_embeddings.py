#!usr/bin/python

import sys
import face_recognition
import cv2

path="/opt/lampp/htdocs/face/"+sys.argv[1]
m = face_recognition.load_image_file(path)
m1 = face_recognition.face_encodings(m)[0]

#print m1
#print type(m1)
b = m1.tolist()
print b
