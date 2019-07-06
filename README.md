## ads-sah-api

This is the backend part proposed.There is another part, the frontend, which is hosted in a separated [repository](https://github.com/NormanColoma/ads-sah-app-react).  

 - **sah-api**: The backend based on **Symfony 4**, provides an API, for retrieving and saving ads. Data is persisted in **MongoDB**
 - **fetch-ads-service**: A simple vanilla PHP script, that fetchs XML data provided, and carries out the transformation of each item to json format. Once the whole XML is processed, it calls to **sah-api** for storing the ads in the backend
 - **ads-sah-app**: It is the frontend part based on React
 
### How to run 

> In order to run the web application, you need to have both, **docker** and **docker-compose** installed. 

Go to root folder and run *docker-compose up*. It will take a while for downloading the different docker images from Dockerhub. Afterwards just go to [http://localhost:3000](http://localhost:3000) (where the App is being served) and you are ready to interact with the application :)

The api is accessible at [http://localhost:8000](http://localhost:8000)

 