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
            "sesiones": "Sitzungen",
          }
        }
      }
    });
  
  window.i18next = i18next;
  
})();