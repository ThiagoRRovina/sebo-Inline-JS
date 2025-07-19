# Use uma imagem PHP oficial como base. 'fpm-alpine' é leve e boa para serviços web.
FROM php:8.2-fpm-alpine

# Define o diretório de trabalho dentro do contêiner
WORKDIR /app

# Instala a extensão PostgreSQL para PHP
# O comando para instalar extensões PHP em imagens oficiais é 'docker-php-ext-install'
RUN docker-php-ext-install pdo_pgsql pgsql

# Copia todos os arquivos da sua aplicação que estão dentro do subdiretório 'trabalho-web'
# do seu repositório para o diretório de trabalho (/app) no contêiner.
COPY trabalho-web/ .

# Expõe a porta que o servidor web PHP embutido irá escutar.
# O Render irá mapear sua porta dinâmica ($PORT) para esta porta exposta (8000).
EXPOSE 8000

# Comando para rodar sua aplicação PHP usando o servidor embutido.
# O '-S 0.0.0.0:8000' especifica o endereço e a porta para escutar.
# O '-t .' define o diretório raiz do documento para o diretório atual (/app).
CMD ["php", "-S", "0.0.0.0:8000", "-t", "."]
