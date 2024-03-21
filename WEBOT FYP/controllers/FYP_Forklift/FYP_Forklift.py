from controller import Supervisor

# create the Supervisor instance.
supervisor = Supervisor()

# get the time step of the current world.
timestep = int(supervisor.getBasicTimeStep())

# get the forklift node
forklift = supervisor.getFromDef('FORKLIFT')
#forklift.getField('rotation').setSFRotation([0, 0, 1, 3.14159])
# Main loop:
# - perform simulation steps until Webots is stopping the controller
while supervisor.step(timestep) != -1:
  pos = forklift.getPosition()
  print(pos)
    