from controller import Robot, GPS, Receiver, Emitter
import time
import mysql.connector
# Initialize devices
robot = Robot()
TIME_STEP = 32

def get_robot_name(robot):
    return robot.getName()

#receiver
receiver = robot.getDevice('receiver')
receiver.enable(TIME_STEP)
receiver.setChannel(2)

#emitter = robot.getDevice('emitter')
#emitter.setChannel(2)
#ROBOT
l1 = robot.getDevice('l1')
l10 = robot.getDevice('l10')
l2 = robot.getDevice('l2')
r2 = robot.getDevice('r2')
linear1 = robot.getDevice('linear motor')
linear2 = robot.getDevice('linear motor2')
motors = robot.getDevice('rotational motor')
position = robot.getDevice('position')
position2 = robot.getDevice('position2')
position3 = robot.getDevice('position3')
position.enable(TIME_STEP)
position2.enable(TIME_STEP)
position3.enable(TIME_STEP)
gps = robot.getDevice('gps')
gps.enable(TIME_STEP)
#ir = robot.getDevice('ir')
#ir.enable(TIME_STEP)
#ir1 = robot.getDevice('ir(1)')
#ir1.enable(TIME_STEP)
led1 = robot.getDevice('led0')
led2 = robot.getDevice('led1')
lidar = robot.getDevice('lidar')
lidar.enable(TIME_STEP)
l = 1  # Initialize l
count = 0


#SENSOR
s1 = robot.getDevice('s1')
s1s = robot.getDevice('s1s')
s1s.enable(TIME_STEP)
l2s = robot.getDevice('l2s')
l2s.enable(TIME_STEP)
ss = robot.getDevice('ss')
ss.enable(TIME_STEP)


foc = robot.getDevice('distance2(1)')
foc.enable(TIME_STEP)
distance2 = robot.getDevice('distance2')
distance2.enable(32)

e = robot.getDevice('e')
e2 = robot.getDevice('e2')
l10 = robot.getDevice('l10')


#button
#touch_sensor = robot.getDevice("button")
#touch_sensor.enable(TIME_STEP)
#led = robot.getDevice("led0")
#led.set(0)


#SENSOR
distance_sensor = robot.getDevice('distance_sensor')
distance_sensor.enable(TIME_STEP)
distance_sensors = robot.getDevice('distance_sensor1')
distance_sensors.enable(TIME_STEP)
distance_sensorss = robot.getDevice('distance_sensor2')
distance_sensorss.enable(TIME_STEP)
distance_sensorsss = robot.getDevice('distance_sensor3')
distance_sensorsss.enable(TIME_STEP)
mode = 0
def step():
  if (robot.step(TIME_STEP) == -1):
    robot.stepEnd();


def passive_wait(sec):
  start_time = robot.getTime()
  while (start_time + sec > robot.getTime()):
    step()


try:
    connection = mysql.connector.connect(
        host="localhost",
        user="root",  # Default user for XAMPP MySQL is 'root'
        password="",  # By default, XAMPP MySQL has no password
        database="warehouse"  # Change this to your desired database name
    )
    
    if connection.is_connected():
        robot_name = get_robot_name(robot)
        print("Robot Name:", robot_name)
# Main control loop
        while robot.step(TIME_STEP) != -1:
                if (robot_name == 'AGV1'):
                    mycursor = connection.cursor()
                # Define the SQL query
                    sql = "SELECT Action,Sku FROM task where Action = 1 ORDER BY Date ASC, Time ASC"
                
                # Execute the SQL query
                    mycursor.execute(sql)    
                    myresult = mycursor.fetchone()    
            #SEnsor
                    distances = foc.getValue()
                    distance = distance_sensor.getValue()
                    distancessss = distance_sensors.getValue()
                    distancess = distance_sensorss.getValue()
                    distancesss = distance_sensorsss.getValue()    
                    if receiver.getQueueLength() > 0:
                        message = receiver.getString()  # Decode the received message
                        receiver.nextPacket()
                        messages = int(message)
                        print(messages)           
                    #START DETECT
                        if messages == 12:
                              print('AGV1 Outbound mode')
                              if distance > 2 and distancessss < 1:
                                     i = "1"  # Obstacle detected left
                              elif distancessss > 2 and distance < 2:
                                     i = "2"  # Obstacle detected right
                              elif distancessss > 2 and distance > 2:
                                     i = "3"  # Left and right
                              else:
                                     i = "0"
                              if i == "1":
                                     e.setPosition(0)        
                                     e2.setPosition(0)
                                     s1.setVelocity(0.5)
                                     s1.setPosition(0)
                                     r2.setPosition(-1)
                                     l10.setPosition(-1)       
                                     linear2.setPosition(-9)
                                     linear1.setPosition(3.85)
                                     print('AGV1 outbound right')
                              if i == "3":
                                     e.setPosition(0)        
                                     e2.setPosition(0)
                                     s1.setVelocity(0.5)
                                     s1.setPosition(0)
                                     r2.setPosition(0) #-1
                                     l10.setPosition(-1)       
                                     linear2.setPosition(-9)
                                     linear1.setPosition(3.85)  
                                     e.setPosition(0)        
                                     e2.setPosition(0)
                                     s1.setVelocity(0.5)
                                     s1.setPosition(0)
                                     r2.setPosition(0)
                                     l10.setPosition(-1)       
                                     print('outbound left and right')
                              elif i == "2":
                                     e.setPosition(0)
                                     e2.setPosition(0)
                                     s1.setVelocity(0.5)
                                     s1.setPosition(0)
                                     r2.setPosition(-1)
                                     l10.setPosition(-1)       
                                     linear2.setPosition(-9)
                                     linear1.setPosition(8.7)  #left right
                                     print('outbound left')             
                              elif i == "0":
                                     e2.setPosition(0)
                                     s1.setVelocity(0.5)
                                     s1.setPosition(0)
                                     r2.setPosition(-1)
                                     l10.setPosition(-1)      
                                     linear2.setPosition(-0)
                                     linear1.setPosition(0)    
                                     print('0 going back')           
                              if (distances > 1.15): #and (message == 3) or message == 2 or message == 1):
                                     passive_wait(2)
                                     s1.setVelocity(0.1)
                                     s1.setPosition(0.25)
                                     r2.setVelocity(20)
                                     r2.setPosition(0.2)
                                     l10.setPosition(0.1)
                                     e.setPosition(0)
                                     passive_wait(5)
                                     e.setPosition(1)               
                                     linear2.setVelocity(0.2)
                                     linear2.setPosition(0)
                                     passive_wait(5)
                                     linear1.setVelocity(0.5)
                                     linear1.setPosition(0)
                                     r2.setVelocity(0.02)
                                     r2.setPosition(-1)
                                     e2.setPosition(1)
                                     passive_wait(40)
                                     e2.setPosition(1)
                                     s1.setVelocity(0.3)
                                     s1.setPosition(0)
                                     l10.setPosition(-4)
                              
                                     linear2.setVelocity(0.5)
                                     linear2.setPosition(0)
                                     for Skus in myresult:
                                         sku = Skus[0]
                                         update_sql = "UPDATE task SET Action = 1 WHERE Sku = %s"
                                         mycursor.execute(update_sql, (sku,))
                                         connection.commit() 
                                    
                                     print(mycursor.rowcount, "record(s) affected")                   
                              elif (distances < 1.15):
                                     s1.setVelocity(0.3)
                                     s1.setPosition(0)
                       
                        elif messages == 11:
                              print('AGV1 inbound mode')
                              if distancesss > 2 and distancess < 1:
                                     i = "4"  # Obstacle detected left
                              elif distancess > 2 and distancesss < 2:
                                     i = "5"  # Obstacle detected right
                              elif distancesss > 2 and distancess > 2:
                                     i = "6"  # Left and right
                              else:       
                                     i = "0"
                              if i == "5":    
                                     e.setPosition(0)
                                     s1.setVelocity(0.5)
                                     s1.setPosition(0)
                                     l2.setPosition(-1)
                                     l1.setPosition(-1)       
                                     linear2.setPosition(0)
                                     passive_wait(6)
                                     linear1.setPosition(0)
                                     print('inbound right')
                              elif i == "4":    
                                     e.setPosition(0)
                                     s1.setVelocity(0.5)
                                     s1.setPosition(0)
                                     l2.setPosition(-1)
                                     l1.setPosition(-1)       
                                     linear2.setPosition(0)
                                     linear1.setPosition(6)
                                     print('inbound left')             
                              if (distances > 1.18) :
                                     passive_wait(1)
                                     s1.setVelocity(0.1)
                                     s1.setPosition(0.25)
                                     l2.setPosition(0.2)
                                     l1.setPosition(0.1)
                                     r2.setPosition(0.2)               
                                     e.setPosition(0)
                                     passive_wait(5)
                                     linear2.setVelocity(0.2)
                                     linear2.setPosition(-9)
                                     passive_wait(5)
                                     linear1.setVelocity(0.5)
                                     linear1.setPosition(8.7)
                                     l2.setVelocity(0.05)
                                     l2.setPosition(-1)
                                     r2.setVelocity(0.05)
                                     r2.setPosition(0)               
                                     e.setPosition(-1)
                                     passive_wait(40)
                                     e.setPosition(-1)
                                     s1.setVelocity(0.3)
                                     s1.setPosition(0)
                                     l10.setPosition(-4)
                              
                                     linear2.setVelocity(0.5)
                                     linear2.setPosition(-0)
                                     for Skus in myresult:
                                         sku = Skus[0]
                                         update_sql = "UPDATE task SET Action = 1 WHERE Sku = %s"
                                         mycursor.execute(update_sql, (sku,))
                                         connection.commit() 
                                    
                                     print(mycursor.rowcount, "record(s) affected")                                   
                                     print('back')
                              elif (distances < 1.15):
                                     s1.setVelocity(0.3)
                                     s1.setPosition(0)   
                  
                elif (robot_name == 'AGV2'):
                    mycursor = connection.cursor()
                # Define the SQL query
                    sql = "SELECT Action,Sku FROM task where Action = 1 ORDER BY Date ASC, Time ASC"
                
                # Execute the SQL query
                    mycursor.execute(sql)    
                    myresult = mycursor.fetchone()    
            #SEnsor
                    distances = foc.getValue()
                    distance = distance_sensor.getValue()
                    distancessss = distance_sensors.getValue()
                    distancess = distance_sensorss.getValue()
                    distancesss = distance_sensorsss.getValue()    
                    if receiver.getQueueLength() > 0:
                        message = receiver.getString()  # Decode the received message
                        receiver.nextPacket()
                        messages = int(message)
                        print(messages)           
                    #START DETECT
                        if messages == 21:
                              print('AGV2 Outbound mode')
                              if distance > 2 and distancessss < 1:
                                     i = "1"  # Obstacle detected left
                              elif distancessss > 2 and distance < 2:
                                     i = "2"  # Obstacle detected right
                              elif distancessss > 2 and distance > 2:
                                     i = "3"  # Left and right
                              else:
                                     i = "0"
                              if i == "1":
                                     e.setPosition(0)        
                                     e2.setPosition(0)
                                     s1.setVelocity(0.5)
                                     s1.setPosition(0)
                                     r2.setPosition(-1)
                                     l10.setPosition(-1)       
                                     linear2.setPosition(-9)
                                     linear1.setPosition(3.85)
                                     print('outbound right')
                              if i == "3":
                                     e.setPosition(0)        
                                     e2.setPosition(0)
                                     s1.setVelocity(0.5)
                                     s1.setPosition(0)
                                     r2.setPosition(0) #-1
                                     l10.setPosition(-1)       
                                     linear2.setPosition(-9)
                                     linear1.setPosition(3.85)  
                                     e.setPosition(0)        
                                     e2.setPosition(0)
                                     s1.setVelocity(0.5)
                                     s1.setPosition(0)
                                     r2.setPosition(0)
                                     l10.setPosition(-1)       
                                     print('outbound left and right')
                              elif i == "2":
                                     e.setPosition(0)
                                     e2.setPosition(0)
                                     s1.setVelocity(0.5)
                                     s1.setPosition(0)
                                     r2.setPosition(-1)
                                     l10.setPosition(-1)       
                                     linear2.setPosition(-9)
                                     linear1.setPosition(8.7)  #left right
                                     print('outbound left')             
                              elif i == "0":
                                     e2.setPosition(0)
                                     s1.setVelocity(0.5)
                                     s1.setPosition(0)
                                     r2.setPosition(-1)
                                     l10.setPosition(-1)      
                                     linear2.setPosition(-0)
                                     linear1.setPosition(0)    
                                     print('0 going back')           
                              if (distances > 1.15): #and (message == 3) or message == 2 or message == 1):
                                     passive_wait(2)
                                     s1.setVelocity(0.1)
                                     s1.setPosition(0.25)
                                     r2.setVelocity(20)
                                     r2.setPosition(0.2)
                                     l10.setPosition(0.1)
                                     e.setPosition(0)
                                     passive_wait(5)
                                     e.setPosition(1)               
                                     linear2.setVelocity(0.2)
                                     linear2.setPosition(0)
                                     passive_wait(5)
                                     linear1.setVelocity(0.5)
                                     linear1.setPosition(0)
                                     r2.setVelocity(0.02)
                                     r2.setPosition(-1)
                                     e2.setPosition(1)
                                     passive_wait(40)
                                     e2.setPosition(1)
                                     s1.setVelocity(0.3)
                                     s1.setPosition(0)
                                     l10.setPosition(-4)
                              
                                     linear2.setVelocity(0.5)
                                     linear2.setPosition(0)
                                     for Skus in myresult:
                                         sku = Skus[0]
                                         update_sql = "UPDATE task SET Action = 1 WHERE Sku = %s"
                                         mycursor.execute(update_sql, (sku,))
                                         connection.commit() 
                                    
                                     print(mycursor.rowcount, "record(s) affected")                   
                              elif (distances < 1.15):
                                     s1.setVelocity(0.3)
                                     s1.setPosition(0)
                       
                        elif messages == 22:
                              print('AGV2 inbound mode')
                              if distancesss > 2 and distancess < 1:
                                     i = "4"  # Obstacle detected left
                              elif distancess > 2 and distancesss < 2:
                                     i = "5"  # Obstacle detected right
                              elif distancesss > 2 and distancess > 2:
                                     i = "6"  # Left and right
                              else:       
                                     i = "0"
                              if i == "5":    
                                     e.setPosition(0)
                                     s1.setVelocity(0.5)
                                     s1.setPosition(0)
                                     l2.setPosition(-1)
                                     l1.setPosition(-1)       
                                     linear2.setPosition(0)
                                     passive_wait(6)
                                     linear1.setPosition(0)
                                     print('inbound right')
                              elif i == "4":    
                                     e.setPosition(0)
                                     s1.setVelocity(0.5)
                                     s1.setPosition(0)
                                     l2.setPosition(-1)
                                     l1.setPosition(-1)       
                                     linear2.setPosition(0)
                                     linear1.setPosition(6)
                                     print('inbound left')             
                              if (distances > 1.18) :
                                     passive_wait(1)
                                     s1.setVelocity(0.1)
                                     s1.setPosition(0.25)
                                     l2.setPosition(0.2)
                                     l1.setPosition(0.1)
                                     r2.setPosition(0.2)               
                                     e.setPosition(0)
                                     passive_wait(5)
                                     linear2.setVelocity(0.2)
                                     linear2.setPosition(-9)
                                     passive_wait(5)
                                     linear1.setVelocity(0.5)
                                     linear1.setPosition(8.7)
                                     l2.setVelocity(0.05)
                                     l2.setPosition(-1)
                                     r2.setVelocity(0.05)
                                     r2.setPosition(0)               
                                     e.setPosition(-1)
                                     passive_wait(40)
                                     e.setPosition(-1)
                                     s1.setVelocity(0.3)
                                     s1.setPosition(0)
                                     l10.setPosition(-4)
                              
                                     linear2.setVelocity(0.5)
                                     linear2.setPosition(-0)
                                     for Skus in myresult:
                                         sku = Skus[0]
                                         update_sql = "UPDATE task SET Action = 1 WHERE Sku = %s"
                                         mycursor.execute(update_sql, (sku,))
                                         connection.commit() 
                                    
                                     print(mycursor.rowcount, "record(s) affected")                                   
                                     print('back')
                              elif (distances < 1.15):
                                     s1.setVelocity(0.3)
                                     s1.setPosition(0)   
                else: 
                                     print(robot_name,"No Task")
                                     s1.setVelocity(0.3)
                                     s1.setPosition(0)                                                                               
except mysql.connector.Error as e:
    print("Error:", e)
