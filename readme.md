
## How to set up:
This is developed with Docker and Vessel shipping container: https://vessel.shippingdocker.com/
I made simple bash script to set up this application easily.
- git clone
- cd into cloned folder.
- ./create-app.sh (if you do not want to use default app port 80 and default mysql port, just add two attributes to the end of file, example: ./create-app-sh 8080 33060. This will automatically add these rows to .env file. More info from here: [Multiple environments](https://vessel.shippingdocker.com/docs/everyday-usage/#multiple-environments))
- you should be good to go, just open localhost.
