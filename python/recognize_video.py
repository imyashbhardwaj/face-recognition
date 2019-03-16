import face_recognition
import cv2
import sys
import mysql.connector
import os
import numpy as np
import math

input_movie = cv2.VideoCapture(sys.argv[1])


#for getting embeddings from database

con = mysql.connector.connect(user='root',password='',host='localhost',database='face_recognition')
cur = con.cursor()
cur.execute("""select * from encodings""")
row = cur.fetchall()
known_faces = list()
names=list()
for i in range(0,len(row)):
	k=(row[i][2])
	known_faces.append(k)
	known_faces[i]=str(known_faces[i])
	known_faces[i]=known_faces[i][1:len(known_faces[i])-2]
	known_faces[i]=known_faces[i].replace(" ","")
	known_faces[i]=known_faces[i].split(",")	
	for x in range(0,len(known_faces[i])):
		known_faces[i][x]=float(known_faces[i][x])
	#name=os.path.splitext(row[i][0])[0]		
	names.append(str(row[i][0]));

cur.close()


# Create an output movie file 
width = input_movie.get(3)
height = input_movie.get(4)
fps = input_movie.get(cv2.CAP_PROP_FPS)
length = int(input_movie.get(cv2.CAP_PROP_FRAME_COUNT))
fourcc = cv2.VideoWriter_fourcc(*'H264')
output_movie = cv2.VideoWriter('/opt/lampp/htdocs/face/recognized_video/output.mp4', fourcc, 3, (int(width), int(height)))

# Initialize some variables
face_locations = []
face_encodings = []
frame_number = 0
fps=math.floor(fps)
fc=0
while True:
	
    # Grab a single frame of video
    ret, frame = input_movie.read()
    
    # Quit when the input video file ends
    if not ret:
        break

    frameId = input_movie.get(1)
    
    if (frameId % fps<4)and(frameId % fps!=0):
	#print ('frameid= ',frameId)			
	rgb_frame = frame[:, :, ::-1]

    
	face_locations = face_recognition.face_locations(rgb_frame)
    	face_encodings = face_recognition.face_encodings(rgb_frame, face_locations)

    	face_names = []
    	for face_encoding in face_encodings:
        
        	match = face_recognition.compare_faces(known_faces, face_encoding, tolerance=0.50)

        
        	name = 'Unknown'
		
		for i in range(0,len(names)):        
			if match[i]:
        	    		name = names[i]
        			break

        	face_names.append(name)
		#print('face_names= ',face_names)
		#print('face_locations= ',face_locations)

    # Label the results
    		for (top, right, bottom, left), name in zip(face_locations, face_names):
    		    	if not name:
				print 'coming here ------'
    	        		continue

    	    # Draw a box around the face
    		    	cv2.rectangle(frame, (left, top), (right, bottom), (0, 0, 255), 2)

        # Draw a label with a name below the face
        		cv2.rectangle(frame, (left, bottom - 25), (right, bottom), (0, 0, 255), cv2.FILLED)
        		font = cv2.FONT_HERSHEY_DUPLEX
        		cv2.putText(frame, name, (left + 6, bottom - 6), font, 0.5, (255, 255, 255), 1)
    # Write the resulting image to the output video file
    	print("Writing frame {} / {}".format(frameId, length))
    #print("Recognizing video file {}% complete".format((frame_number/length)*100))	
	#filename ='/opt/lampp/htdocs/face_rec/recognized_video/'+"image_" +  str(int(fc)) + ".jpg"
        #cv2.imwrite(filename, frame)    	
	output_movie.write(frame)
	fc+=1;

# All done!
print fc
input_movie.release()
cv2.destroyAllWindows()

