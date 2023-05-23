# importamos librerias
import torch
import cv2
import numpy as np
import pandas
import sys
import os 

# leemos el modelo

model = torch.hub.load('ultralytics/yolov5', 'custom', path='C:/Users/Ommaa/Downloads/GreeCoon/Modelo/PlantasM.pt')

# realizamos videocaptura

# cap = cv2.VideoCapture(0)
# entradaPy = sys.argv
# print(entradaPy)

# entradaPy = "/imagenes/" + entradaPy[1]
#print(entradaPy)
imagen = cv2.imread('imagenes/plantaImg.jpg',1)

detect = model(imagen)

sr = detect.pandas().xyxy[0].name.to_string()
outArray = sr.split()
output = outArray[1]
print(output)
# print(type(output))

# print('La planta es una: ' + arreglo[0])
# print(type(arreglo[0]))

# cv2.waitKey(0)
# cv2.destroyAllWindows()
cv2.waitKey(0)
cv2.destroyAllWindows()

# empezamos con while-true.

# while True:
#     # realizar lectura de videocaptura.
#     ret, frame = cap.read()

#     # realizamos detecciones

#     detect = model(frame)

#     # mostramos FPS.
#     cv2.imshow("Detector de plantas", np.squeeze(detect.render()))

#     # leer el teclado.

#     t = cv2.waitKey(5)
#     if t == 27:
#         break

# cap.release()

####cv2.destroyAllWindows()