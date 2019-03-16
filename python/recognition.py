import sys 
import face_recognition
import mysql.connector
import os
import ast
import numpy as np

unknown_image = face_recognition.load_image_file(sys.argv[1])
face_locations = face_recognition.face_locations(unknown_image)

print("{} face(s) found in this photograph.\n".format(len(face_locations)))

unknown_face_encodings=list()
for i in range(0,len(face_locations)):
	unknown_face_encodings.append(face_recognition.face_encodings(unknown_image)[i])

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


#print known_faces[1]
#print type(known_faces[0][0])
for i in range(0,len(face_locations)):
	results = face_recognition.compare_faces(known_faces, unknown_face_encodings[i])
	if bool(True) in results:	
		index=results.index(bool(True))
		#print results	
		s="The photo is of "+names[index]+"."
		print s
	else:
		print("No known face is found")

os.remove(sys.argv[1])
