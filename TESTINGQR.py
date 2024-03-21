from controller import Robot, Camera
import numpy as np
import cv2
import datetime

robot = Robot()
camera = robot.getDevice("camera")
camera.enable(100) 
led = robot.getDevice('led0')
qr_code_content = set()
qr_code_count = 0  

while robot.step(1000) != -1:
    led.set(1)
    image = camera.getImage()
    width, height = camera.getWidth(), camera.getHeight()
    image_array = np.frombuffer(image, np.uint8).reshape((height, width, 4))
    gray_image = cv2.cvtColor(image_array, cv2.COLOR_BGR2GRAY)
    qr_code_detector = cv2.QRCodeDetector()
    decoded_info, _, _ = qr_code_detector.detectAndDecode(gray_image)

    if decoded_info:
        current_time = datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S")
        if decoded_info not in qr_code_content:
            print(f"{current_time}: New QR code found! Content: {decoded_info}")
            qr_code_content.add(decoded_info)
            qr_code_count += 1
            with open("notes.txt", "a") as notes_file:
                notes_file.write(f"{current_time}: {decoded_info} (Count: {qr_code_count})\n")
            
            if decoded_info == "Melaka":
                print(f"Price for 'Melaka': 100")
            elif decoded_info == "Johor":
                print(f"Price for 'Johor': 100")
        else:
            print(f"{current_time}: Duplicate QR code found! Content: {decoded_info}")