from controller import Supervisor

supervisor = Supervisor()
timestep = int(supervisor.getBasicTimeStep())

epuck = supervisor.getFromDef("EPUCK")

while supervisor.step(timestep) != -1:
    position = epuck.getPosition()
    print("Position:", position)
