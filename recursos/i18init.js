(function i18init(){
  window.preferredLanguage = document.documentElement.lang;
  
    i18next.init({
      lng: window.preferredLanguage,
      resources: {
        es: {
          translation: {
            "principal": "Principal",
            "quienes_somos": "Quienes somos",
            "objetivos": "Objetivos",
            "reservaciones": "Reservaciones",
            "tutoriales": "Tutoriales",
            "aprendizaje_autoregulado": "Aprendizaje Autorregulado",
            "buscar_recursos": "Buscar Recursos",
            "sesiones": "Sesiones",
            "entrar": "Entrar",
            "salir": "Salir",
            "usuario": "Usuario:",
            "pass": "Contraseña:",
            "olvidaste_tu_contra": "¿Olvidaste tu contraseña?",
            "mensaje_bienvenida": "Bienvenido a la página del Laboratorio de Idiomas del Departamento de Lenguas Modernas",
            "quienes_somos": "Quienes Somos",
            "quienes_somos_message_1": "El Laboratorio de Idiomas es un espacio de aprendizaje cuya infraestructura tecnológica de vanguardia facilita la práctica y el aprendizaje de los idiomas impartidos por el Departamento de Lenguas Modernas de la División de Humanidades y Ciencias Sociales y por el Centro de Estudios para extranjeros de la Dirección de Programas Internacionales.",
            "quienes_somos_message_2": "Estamos ubicados en el edificio del CIAP en los salones 423 y 424. Los horarios del laboratorio son de lunes a viernes de 8:00 am a 7:00 pm y los sabados de 10:00 a 2:00",
            "puesto1": "Coordinador Academico Administrativo Laboratorio de Idiomas",
            "puesto2": "Coordinador Tecnológico Laboratorio de Idiomas",
            "puesto3": "Auxiliar Administrativo",
            "personal": "Personal"

      
          }
        },
        en: {
          translation: {
            "principal": "Main",
            "quienes_somos": "Who we are",
            "objetivos": "Objectives",
            "reservaciones": "Reservations",
            "tutoriales": "Tutorials",
            "aprendizaje_autoregulado": "Self-regulated learning",
            "buscar_recursos": "Search Resources",
            "sesiones": "Sessions",
            "entrar": "Enter",
            "salir": "Exit",
            "usuario": "User:",
            "pass": "Password:",
            "olvidaste_tu_contra": "Forgot your password?",
            "mensaje_bienvenida": "Welcome to the webpage of Laboratorio de Idiomas of the Modern Languages Department",
            "quienes_somos": "Who We Are",
            "quienes_somos_message_1": "Laboratorio de Idiomas is a learning space which its forefront technologic infrastructure facilitates the learning and practice of the taught languages by the Modern Languages Department of the Human and Social Sciences and by the Research Department for foreigners from the Internationals Program Department.",
            "quienes_somos_message_2": "We are located in the CIAP building in the rooms 423 and 424. The schedule for the laboratory are from Monday to Friday from 8:00 am to 7:00pm and Saturdays from 10:00am to 2:00pm.",
            "puesto1": "Administrative coordinator of Laboratorio de Idiomas",
            "puesto2": "Technological coordinator of Laboratorio de Idiomas",
            "puesto3": "Administrative Assistant",
            "personal": "Staff"
          }
        },
        de: {
          translation: {
            "principal": "Main",
            "quienes_somos": "Uns",
            "objetivos": "Ziele",
            "reservaciones": "Reservierungen",
            "tutoriales": "Tutorials",
            "aprendizaje_autoregulado": "Selbstlernen",
            "buscar_recursos": "Ressourcen suchen",
            "sesiones": "Sitzungen"
          }
        }
      }
    });
  
  window.i18next = i18next;
  
})();