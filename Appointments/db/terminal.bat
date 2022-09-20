@echo off
start json-server --watch users.json -p 3000 /min
start json-server --watch appointments.json -p 4000 /min
exit