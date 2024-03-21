"""SLFR_V5_p controller."""

# You may need to import some classes of the controller module. Ex:
#  from controller import Robot, Motor, DistanceSensor
from controller import Supervisor

# create the Robot instance.
robot = Supervisor()

robotNode = robot.getSelf()

# get the time step of the current world.
time_step = int(robot.getBasicTimeStep())

# Initialize Motos 
left_motor = robot.getDevice('left wheel motor')
right_motor = robot.getDevice('right wheel motor')
left_motor.setPosition(float('inf'))
right_motor.setPosition(float('inf'))

left_speed = 0
right_speed = 0

left_motor.setVelocity(left_speed)
right_motor.setVelocity(right_speed)


# Initialize camera
camera = robot.getDevice('camera')
camera.enable(time_step)

# Initialize LEDs
leds = []
for i in range(5):
    led = robot.getDevice('led' + str(i))
    leds.append(led)
    led.set(1)

Kp = 14
Ki = 0.02
Kd = 0.12
P = 0
I = 0
D = 0
oldP = 0
maxS = 138
maxV = 0

# IR ground sensors
ground_sensors = []


for i in range(8):
    gs = robot.getDevice('gs' + str(i))
    gs.enable(time_step)
    ground_sensors.append(gs)
    
def Error_Position(pos):
    position = 0
    nTrue = 0
    for i in range(8):
        if ground_sensors[i].getValue() > 200:
            position += i
            nTrue += 1
    if nTrue == 0:
        return pos
    return position / nTrue - 3.5

def posLED():
    if P > -1 and P < 1:
        leds[1].set(1)
    else:
        leds[1].set(0)

    if P  < -0.8:
        leds[0].set(1)
    else:
        leds[0].set(0)

    if P  > 0.8:
        leds[2].set(1)
    else:
        leds[2].set(0)

# Main loop:
# - perform simulation steps until Webots is stopping the controller
while robot.step(time_step) != -1:

    P = Error_Position(P)
    I += P * time_step / 1000
    D = D * 0.5 + (P - oldP) / time_step * 1000
    PID = Kp * P + Ki * I + Kd * D
    oldP = P
    
    medS = maxS - abs(PID)
    left_speed = medS + PID
    right_speed = medS - PID
   
    
    left_motor.setVelocity(left_speed)
    right_motor.setVelocity(right_speed)
    
    posLED()
    
    velVector = robotNode.getVelocity()
    velocity = (velVector[0]**2 + velVector[1]**2 + velVector[2]**2)**0.5
    
    if velocity > maxV:
        maxV = (velocity + maxV)/2
        
    strP = f'Speed: {velocity:.2f} m/s  Max: {maxV:.2f} m/s'
    
    if robotNode == robot.getFromDef('SLFR_V5A'):
        robot.setLabel(0,strP,0,0.97,0.05,0x165282,0,'Lucida Console')
    
    if robotNode == robot.getFromDef('SLFR_V5B'):
        robot.setLabel(0,strP,0,0.94,0.05,0x292933,0,'Lucida Console')

    pass

# Enter here exit cleanup code.
