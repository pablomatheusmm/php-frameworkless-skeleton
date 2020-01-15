<p align="center"><img src='https://cdn2.madeiramadeira.com.br/banner/images/53412039-logo.png' width='405' border='0'></p>

# SKELETON 

### Visão Geral

O skeleton é um framework desenvolvido pela madeiramadeira para facilitar o desenvolvimento dos microserviços da empresa visando agilidade e performance.

### Instalação

#### Código do docker-compose.yml

    nginx_skeleton:
        container_name: nginx_skeleton
        build: [DIRETÓRIO DO SEU PROJETO LOCAL]
        volumes:
            - "[DIRETÓRIO DO SEU PROJETO LOCAL]:/var/www/skeleton"
        ports:
            - "8586:8586"
        links:
            - php
            
OBS.: para modificar a porta ou o diretório do projeto no containter voce deve modificar não só o arquivo do docker-compose.yml como também o arquivo do nginx localizado em [DIRETÓRIO DO SEU PROJETO LOCAL]/docker/nginx.conf


### Rodando o projeto

Para rodar o projeto é bem fácil, uma vez feito o processo de instalação voce deve rodar o comando 
    
    docker-compose up --build

e logo após voce pode ver o seu projeto rodando abrindo o navegador e digitando 
    
    http://localhost:8586    
 