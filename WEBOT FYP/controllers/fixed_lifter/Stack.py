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


def run():
  epuck = supervisor.getFromDef("M01S")
  while supervisor.step(TIME_STEP) != -1:
    position = epuck.getPosition()
    print("Position:", position)
