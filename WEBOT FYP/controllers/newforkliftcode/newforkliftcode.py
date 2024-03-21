"""controllerforforklift controller."""

# You may need to import some classes of the controller module. Ex:
#  from controller import Robot, Motor, DistanceSensor
from controller import Robot

robot = Robot()
TIME_STEP = 64
    
ww = 0
wwww = 0
speed = 4
totall = 0
totall1 = 0
totall2 = 0
totall3 = 0

li = robot.getDevice('linear')
li.setVelocity(0.02)
li.setPosition(0.04)

#access 4 wheels
w1 = robot.getDevice('wheel1')
w2 = robot.getDevice('wheel2')
w3 = robot.getDevice('wheel3')
w4 = robot.getDevice('wheel4')
w1.setPosition(float('inf'))
w2.setPosition(float('inf'))
w3.setPosition(float('inf'))
w4.setPosition(float('inf'))

#access lidar
lidar = robot.getDevice('lidar')
lidar.enable(TIME_STEP)
lidar.enablePointCloud

lidar1 = robot.getDevice('lidar1')
lidar1.enable(TIME_STEP)
lidar1.enablePointCloud

lidar2 = robot.getDevice('lidar2')
lidar2.enable(TIME_STEP)
lidar2.enablePointCloud

lidara1 = robot.getDevice('lidara1')
lidara1.enable(TIME_STEP)
lidara1.enablePointCloud

fork = robot.getDevice('lidarfork')
fork.enable(TIME_STEP)
fork.enablePointCloud

#access distance sensor
sharp1 = robot.getDevice('ds')
sharp1.enable(TIME_STEP)
sharp2 = robot.getDevice('ds1')
sharp2.enable(TIME_STEP)
sharp3 = robot.getDevice('ds2')
sharp3.enable(TIME_STEP)
sharp4 = robot.getDevice('ds3')
sharp4.enable(TIME_STEP)

def speedo(s1, s2, s3, s4):
  w1.setVelocity(s1)
  w2.setVelocity(s2)
  w3.setVelocity(s3)
  w4.setVelocity(s4)



while robot.step(TIME_STEP) != -1:
  totall = 0
  totall1 = 0
  totall2 = 0
  totall3 = 0
  totall4 = 0
  
  lidar_value = lidar.getRangeImage()
  lidar_value1 = lidar1.getRangeImage()
  lidar_value2 = lidar2.getRangeImage()
  lidara_value = lidara1.getRangeImage()
  fork_value = fork.getRangeImage()
  
  #print(lidara_value)
  sharp_value = sharp1.getValue()
  sharp_value1 = sharp2.getValue()
  sharp_value3 = sharp3.getValue()
  sharp_value4 = sharp4.getValue()
  
  for i in range(5):
    if(lidar_value[i] < 3.25):   #3.32
      totall = totall + 1

  for j in range(5):
    if(lidar_value1[j] < 0.06):
      totall1 = totall1 + 1
      
  for k in range(5):
    if(lidar_value2[k] < 0.20):
      totall2 = totall2 + 1
      
  #print(sharp_value3, sharp_value4)
  for l in range(1000):
    if(fork_value[l] < 1.1):
      totall3 = totall3 + 1
  
  #print(lidar_value)
  
  #speedo(4, 4, 4, 4)
  print(sharp_value, sharp_value1)
  for m in range(510):
    if(lidara_value[m] < 1.15):
      totall4 = totall4 + 1
  #print('boi')    
  #print(lidar_value, totall4)
  #print(fork_value)   
  #print(lidar_value)
  #print(totall, totall4)
  #print(totall3)
  total = sharp_value < 2500
  total1 = sharp_value1 < 2500
  total2 = sharp_value > 2500
  total3 = sharp_value1 > 2500
  
  total4 = sharp_value3 < 2500
  total5 = sharp_value4 < 2500
  total6 = sharp_value3 > 2500
  total7 = sharp_value4 > 2500
  
  #print(lidar_value1[0:5], totall1, totall2, totall3)
     #step 2  
    
  #print(totall4)

  
  if(totall3 == 0):  
      #step 3 
    print('blskfdndfsfsd')
    print(totall1, totall2)
    if(totall1 == 5 and totall2 != 5):
      if(total4): 
        speedo(-1, 1, -1, 1)
        print('haha')
    
      elif(total5):
        speedo(1, -1, 1, -1)
        print('papa')
      
      elif(total6 and total7):
        speedo(-4, -4, -4, -4) 
        print('rstraight')
        
    elif(totall2 == 5 and totall1 == 5 and totall3 == 0):
      speedo(0, 0, 0, 0)
      li.setPosition(0.01)  
      print('stop')
    
          
  elif(totall3 >= 5 and totall4 >= 5):
    speedo(0,0,0,0)
    
  elif(totall4 == 0 and totall3 >= 5):
    #step 1
    if(totall != 5 and totall1 != 5):
      if(total):
        speedo(-1.5, 2, -1.5, 2)
        print('sleft')          
    
      elif(total1):
        speedo(2, -1.5, 2, -1.5)
        print('sright')
    
      elif(total2 and total3):
        speedo(4, 4, 4, 4)
        print('sstraight')        
          
    elif(totall == 5 and totall1 != 5 and totall2 != 5):
      speedo(0, 0, 0, 0)
      li.setVelocity(0.2)
      li.setPosition(0.01)
      print('down')
      
  if(totall4 == 0 and totall3 == 0 and totall1 == 0):
    speedo(0, 0, 0, 0)    
    
      
  if(totall2 == 5 and totall3 >= 5 and totall1 == 5):
    li.setPosition(0.04)               

    
    #elif(totall == 5):
      #speedo(0, 0, 0, 0)
      #print('unload')
