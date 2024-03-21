import numpy as np
from controller import Supervisor, Camera
import sys
import cv2
import json
import datetime
import os
import mysql.connector
from datetime import datetime

supervisor = Supervisor()
TIME_STEP = int(supervisor.getBasicTimeStep())
calcux = 0
calcuxs = 0
calcuy = 0
calcuys = 0
lm1 = supervisor.getDevice('lm1')
lm2 = supervisor.getDevice('lm2')
lm3 = supervisor.getDevice('lm3')
lm4 = supervisor.getDevice('lm4')
search = supervisor.getDevice('search')
search.enable(TIME_STEP)
searchs = supervisor.getDevice('search1')
searchs.enable(TIME_STEP)
detector = supervisor.getDevice('detector')
detector.enable(TIME_STEP)
receiver = supervisor.getDevice('receiver')
receiver.enable(TIME_STEP)
camera = supervisor.getDevice("camera")
camera.enable(100)
camera1 = supervisor.getDevice("camera1")
camera1.enable(100)
camera2 = supervisor.getDevice("camera2")
camera2.enable(100)
ds_checker = supervisor.getDevice('ds_checker')
ds_checker.enable(TIME_STEP)
pm1 = supervisor.getDevice('pm1')
pm1.enable(TIME_STEP)
pm2 = supervisor.getDevice('pm2')
pm2.enable(TIME_STEP)
pm3 = supervisor.getDevice('pm3')
pm3.enable(TIME_STEP)
pm4 = supervisor.getDevice('pm4')
pm4.enable(TIME_STEP)


def run():
  while supervisor.step(TIME_STEP) != -1:
    lm1.setVelocity(2.5)
    lm1.setPosition(0.0)
    motor = pm1.getValue()
    motor1 = pm2.getValue()
    motor2 = pm3.getValue()
    motor3 = pm4.getValue()
    print(motor,motor1,motor2,motor3)
    if(motor == 0.0):
      lm2.setVelocity(2.5)
      lm2.setPosition(1)
    
