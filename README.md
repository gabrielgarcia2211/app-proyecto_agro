
# **Control de Egresados - Universidad Francisco de Paula Santander** 🎓

![Logo UFPS](https://upload.wikimedia.org/wikipedia/commons/thumb/c/c5/UFPS_logo.svg/1200px-UFPS_logo.svg.png)

## **Descripción** 📜
Este proyecto es una **herramienta de control de egresados** del programa de **Ingeniería Agroindustrial** de la **Universidad Francisco de Paula Santander (UFPS)**. Centraliza información relevante sobre los egresados, como publicaciones de empleos, rendimiento en pruebas Saber, y el impacto de los egresados en la comunidad y la región. Alineado con la **misión y visión** del programa, el sistema facilita la gestión de esta información y contribuye al desarrollo de la región.

## **Misión** 🎯
El Ingeniero Agroindustrial de la UFPS está comprometido con el **mejoramiento continuo** y la calidad de los procesos académicos y administrativos. El objetivo es formar **Ingenieros Agroindustriales** capaces de **resolver problemas del entorno**, promoviendo el desarrollo sostenible, la calidad en los procesos educativos y la transferencia de conocimiento.

## **Visión** 🌍
Para el año 2019, el programa será reconocido a nivel nacional por su **alta calidad**, **competitividad**, **generación de conocimiento**, y por la formación de profesionales con **responsabilidad social**, que contribuirán al **desarrollo local y global**.

## **Tecnologías Usadas** ⚙️
- **Backend**: Laravel (PHP)
- **Frontend**: JavaScript (Vanilla JS, jQuery, Vue.js)
- **Base de Datos**: MySQL
- **Docker**: Contenedores para facilitar la instalación y despliegue del proyecto
- **API**: RESTful para interacción con el frontend
- **Gestión de Dependencias**: Composer (PHP), npm (JavaScript)

## **Instalación** 🔧

1. **Clona el repositorio**:
   ```bash
   git clone <URL del repositorio>
   ```

2. **Instala las dependencias de PHP**:
   ```bash
   composer install
   ```

3. **Instala las dependencias de JavaScript**:
   ```bash
   npm install
   ```

4. **Configura el archivo `.env`**:
   Copia el archivo `.env.example` a `.env` y ajusta las variables de entorno necesarias:
   ```bash
   cp .env.example .env
   ```

5. **Genera la clave de la aplicación (si usas Laravel)**:
   ```bash
   php artisan key:generate
   ```

6. **Ejecuta las migraciones de la base de datos**:
   ```bash
   php artisan migrate
   ```

7. **Ejecuta el proyecto en Docker**:
   Si estás usando Docker, puedes levantar el entorno con el siguiente comando:
   ```bash
   docker-compose up --build
   ```

8. **Accede al proyecto**:
   Una vez que todo esté en funcionamiento, abre tu navegador y accede a:
   ```
   http://localhost:8000
   ```

## **Uso** 🔍

### **Funcionalidades Principales**:
- Registro y seguimiento de **egresados**.
- Publicación de **ofertas de empleo**.
- Consultas sobre el **rendimiento en pruebas Saber**.
- Información sobre el **impacto social** de los egresados.

### **Interfaz**:
El proyecto cuenta con una interfaz intuitiva para la gestión de datos de los egresados y la interacción con los usuarios de la comunidad universitaria.

## **Contribución** 🤝

Si deseas contribuir a este proyecto, sigue estos pasos:
1. Haz un **fork** del repositorio.
2. Crea una nueva **rama** para tus cambios.
3. Realiza un **Pull Request** describiendo los cambios implementados.

