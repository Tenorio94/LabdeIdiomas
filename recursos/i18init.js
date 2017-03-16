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
            "olvidaste_tu_contra": "¿Olvidaste tu contraseña?"
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
            "olvidaste_tu_contra": "Forgot your password?"
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