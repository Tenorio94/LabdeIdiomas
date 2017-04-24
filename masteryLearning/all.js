/// <reference path="typedefs/angularjs/angular.d.ts"/>
/// <reference path="typedefs/angularjs/angular-ui-router.d.ts"/>
/// <reference path="typedefs/d3/d3.d.ts"/>
/// <reference path="typedefs/jquery/jquery.d.ts"/>
var basePath = 'masteryLearning/';
//basePath = '';
var appModule = angular.module("masteryLearning", ['ui.router']);
var ML;
(function (ML) {
    var Controllers;
    (function (Controllers) {
        var CompetenciasController = (function () {
            function CompetenciasController($scope, $http) {
                var competence = $scope.competence = new ML.Models.Competence(0, "", null, []);
                var config = { method: "GET", url: basePath + "queryDB.php?op=getCompetence&id=" + $scope.courseId };
                $http(config).then(function (promiseValue) {
                    var competences = promiseValue.data;
                    var dictionary = {};
                    competences.push(competence);
                    dictionary[competence.id] = competence;
                    for (var i = 0, len = competences.length - 1; i < len; i++) {
                        var newComp = new ML.Models.Competence(competences[i].id, competences[i].name, dictionary[pid], []);
                        dictionary[competences[i].id] = newComp;
                    }
                    for (var i = 0, len = competences.length - 1; i < len; i++) {
                        var pid = competences[i].parent;
                        if (!pid)
                            pid = 0;
                        if (!dictionary[pid].children)
                            dictionary[pid].children = [];
                        dictionary[competences[i].id].parent = dictionary[pid];
                        dictionary[pid].children.push(dictionary[competences[i].id]);
                    }
                }, function (error) {
                });
                this.scope = $scope;
            }
            return CompetenciasController;
        })();
        Controllers.CompetenciasController = CompetenciasController;
    })(Controllers = ML.Controllers || (ML.Controllers = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Controllers;
    (function (Controllers) {
        var CourseController = (function () {
            function CourseController($scope, $http) {
                var config = { method: "GET", url: basePath + "queryDB.php?op=getCourseDescription&id=" + $scope.courseId };
                $http(config).then(function (promiseValue) {
                    var course = promiseValue.data;
                    $scope.course = course[0];
                }, function (error) {
                });
                this.scope = $scope;
            }
            return CourseController;
        })();
        Controllers.CourseController = CourseController;
    })(Controllers = ML.Controllers || (ML.Controllers = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Controllers;
    (function (Controllers) {
        var CourseDetailController = (function () {
            function CourseDetailController($scope, $http) {
                var _this = this;
                var config = { method: "GET", url: basePath + "queryDB.php?op=getCourseDescription&id=" + $scope.courseId };
                $http(config).then(function (promiseValue) {
                    var course = promiseValue.data;
                    _this.scope.course = course[0];
                }, function (error) {
                    //alert("Hubo un error al cargar los cursos.");
                });
                this.scope = $scope;
            }
            return CourseDetailController;
        })();
        Controllers.CourseDetailController = CourseDetailController;
    })(Controllers = ML.Controllers || (ML.Controllers = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Controllers;
    (function (Controllers) {
        var CreateCourseCompetenciasController = (function () {
            function CreateCourseCompetenciasController($scope, $http) {
                var _this = this;
                var competence = $scope.competence = new ML.Models.Competence(0, "", null, []);
                var config = { method: "GET", url: basePath + "queryDB.php?op=getCompetence&id=" + $scope.courseId };
                $http(config).then(function (promiseValue) {
                    var competences = promiseValue.data;
                    var dictionary = {};
                    competences.push(competence);
                    dictionary[competence.id] = competence;
                    for (var i = 0, len = competences.length - 1; i < len; i++) {
                        var newComp = new ML.Models.Competence(competences[i].id, competences[i].name, dictionary[pid], []);
                        dictionary[competences[i].id] = newComp;
                    }
                    for (var i = 0, len = competences.length - 1; i < len; i++) {
                        var pid = competences[i].parent;
                        if (!pid)
                            pid = 0;
                        if (!dictionary[pid].children)
                            dictionary[pid].children = [];
                        dictionary[competences[i].id].parent = dictionary[pid];
                        dictionary[pid].children.push(dictionary[competences[i].id]);
                    }
                }, function (error) {
                });
                $scope.edit = this.edit;
                $scope.newCompetence = function () {
                    var config = { method: "GET", url: basePath + "queryDB.php?op=createCompetence&cid=" + $scope.courseId + "&name=" + CreateCourseCompetenciasController.EmptyCompetence + "&parent=0" };
                    $http(config).then(function (promiseValue) {
                        var compId = promiseValue.data[0].id;
                        competence.children.push(new ML.Models.Competence(compId, CreateCourseCompetenciasController.EmptyCompetence, _this.scope.competence, null));
                    }, function (error) {
                    });
                };
                $scope.erase = function (competence) {
                    var id = _this.getIdinParentChilds(competence);
                    if (confirm("Realmente desea borrar " + competence.name + " y todos sus hijos.")) {
                        competence.parent.children.splice(id, 1);
                        var config = { method: "GET", url: basePath + "queryDB.php?op=deleteCompetence&id=" + competence.id };
                        $http(config).then(function (promiseValue) {
                        }, function (error) {
                        });
                    }
                };
                $scope.saveCompetence = function (competence) {
                    var config = { method: "GET", url: basePath + "queryDB.php?op=updateCompetence&cid=" + $scope.courseId + "&id=" + competence.id + "&name=" + competence.name + "&parent=" + competence.parent.id };
                    $http(config).then(function (promiseValue) {
                    }, function (error) {
                    });
                };
                $scope.change = function ($event, competence) {
                    var tabKey = 9;
                    var enterKey = 13;
                    var upKey = 38;
                    var downKey = 40;
                    var setFocus = true;
                    switch ($event.keyCode) {
                        case enterKey:
                            competence.edit = false;
                            if (competence.name == "") {
                                competence.name = CreateCourseCompetenciasController.EmptyCompetence;
                            }
                            setFocus = false;
                            break;
                        case tabKey:
                            if ($event.preventDefault) {
                                $event.preventDefault();
                            }
                            if ($event.shiftKey) {
                                _this.moveLeft(competence);
                            }
                            else {
                                _this.moveRight(competence);
                            }
                            break;
                        case upKey:
                            var id = _this.moveUp(competence);
                            _this.saveIdChanges(id, competence);
                            break;
                        case downKey:
                            var id = _this.moveDown(competence);
                            _this.saveIdChanges(id, competence);
                            break;
                    }
                    if (setFocus) {
                        setTimeout(function () { $(document).find('#' + competence.id)[0].focus(); }, 100);
                    }
                    $scope.saveCompetence(competence);
                };
                this.scope = $scope;
            }
            //Saves changes to idParent in the direct children of the competences we swapped ids between
            CreateCourseCompetenciasController.prototype.saveIdChanges = function (id, competence) {
                var scope = this.scope;
                for (var i = 0, len = competence.children.length; i < len; i++) {
                    scope.saveCompetence(competence.children[i]);
                }
                scope.saveCompetence(competence.parent.children[id]);
                var childs = competence.parent.children[id].children;
                for (var i = 0, len = childs.length; i < len; i++) {
                    scope.saveCompetence(childs[i]);
                }
            };
            CreateCourseCompetenciasController.prototype.getIdinParentChilds = function (competence) {
                var childs = competence.parent.children;
                for (var i = 0, len = childs.length; i < len; i++) {
                    if (childs[i].id == competence.id) {
                        return i;
                    }
                }
                return -1;
            };
            CreateCourseCompetenciasController.prototype.moveUp = function (competence) {
                var id = this.getIdinParentChilds(competence);
                if (id > 0) {
                    var childs = competence.parent.children;
                    var temp = childs[id - 1].id;
                    childs[id - 1].id = competence.id;
                    competence.id = temp;
                    childs.splice(id, 1);
                    var comp = new ML.Models.Competence(competence.id, competence.name, competence.parent, competence.children);
                    comp.edit = true;
                    childs.splice(id - 1, 0, comp);
                }
                return id;
            };
            CreateCourseCompetenciasController.prototype.moveDown = function (competence) {
                var childs = competence.parent.children;
                var id = this.getIdinParentChilds(competence);
                if (id < childs.length - 1) {
                    childs.splice(id, 1);
                    var temp = childs[id].id;
                    childs[id].id = competence.id;
                    competence.id = temp;
                    childs.splice(id + 1, 0, competence);
                }
                return id;
            };
            CreateCourseCompetenciasController.prototype.moveRight = function (competence) {
                var id = this.getIdinParentChilds(competence) - 1;
                if (id >= 0) {
                    var childs = competence.parent.children;
                    childs.splice(id + 1, 1);
                    if (!childs[id].children) {
                        childs[id].children = [];
                    }
                    childs[id].children.push(competence);
                    competence.parent = childs[id];
                }
            };
            CreateCourseCompetenciasController.prototype.moveLeft = function (competence) {
                var compParent = competence.parent;
                if (compParent.parent) {
                    var f = this.getIdinParentChilds(compParent);
                    if (f >= 0) {
                        var childs = compParent.parent.children;
                        var ch2 = compParent.children;
                        var id = this.getIdinParentChilds(competence);
                        ch2.splice(id, 1);
                        childs.splice(f + 1, 0, competence);
                        competence.parent = childs[f].parent;
                    }
                }
            };
            CreateCourseCompetenciasController.prototype.edit = function ($event, competence) {
                competence.edit = true;
                //Super hack, we probably dont want this
                setTimeout(function () { $($($event.currentTarget)[0].parentNode).find('input')[0].focus(); }, 50);
            };
            CreateCourseCompetenciasController.EmptyCompetence = "Competencia vacía";
            return CreateCourseCompetenciasController;
        })();
        Controllers.CreateCourseCompetenciasController = CreateCourseCompetenciasController;
    })(Controllers = ML.Controllers || (ML.Controllers = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Controllers;
    (function (Controllers) {
        var CreateCourseController = (function () {
            function CreateCourseController($scope, $http) {
                if (!$scope.courseId) {
                    var config = { method: "GET", url: basePath + "queryDB.php?op=createCourse&name=" + CreateCourseController.EmptyCourseName + "description=" + CreateCourseController.EmptyCourseDescription };
                    $http(config).then(function (promiseValue) {
                        $scope.course.id = $scope.courseId = promiseValue.data[0];
                    }, function (error) {
                        //alert("Hubo un error al cargar los cursos.");
                    });
                }
                else {
                    var config = { method: "GET", url: basePath + "queryDB.php?op=getCourseDescription&id=" + $scope.courseId };
                    $http(config).then(function (promiseValue) {
                        $scope.course = promiseValue.data[0];
                    }, function (error) {
                        //alert("Hubo un error al cargar los cursos.");
                    });
                }
                $scope.saveCourse = function (course) {
                    var nameToSend = course.name;
                    if (!nameToSend || nameToSend == '') {
                        nameToSend = CreateCourseController.EmptyCourseName;
                    }
                    var descriptionToSend = course.description;
                    if (!descriptionToSend || descriptionToSend == '') {
                        descriptionToSend = CreateCourseController.EmptyCourseDescription;
                    }
                    var config = {
                        method: "GET", url: basePath + "queryDB.php?op=updateCourse&id=" + course.id
                            + "&name=" + nameToSend
                            + "&description=" + descriptionToSend
                    };
                    $http(config).then(function (promiseValue) {
                    }, function (error) {
                    });
                };
                $scope.updateName = function (course) {
                    $scope.saveCourse(course);
                };
                $scope.updateDescription = function (course) {
                    $scope.saveCourse(course);
                };
                this.scope = $scope;
            }
            CreateCourseController.EmptyCourseName = 'Curso sin nombre';
            CreateCourseController.EmptyCourseDescription = 'Curso sin descripción';
            return CreateCourseController;
        })();
        Controllers.CreateCourseController = CreateCourseController;
    })(Controllers = ML.Controllers || (ML.Controllers = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Controllers;
    (function (Controllers) {
        var CreateCourseEvaluacionesController = (function () {
            function CreateCourseEvaluacionesController($scope, $http) {
                var _this = this;
                var competence = $scope.competence = new ML.Models.Competence(0, "", null, []);
                var config = { method: "GET", url: basePath + "queryDB.php?op=getCompetence&id=" + $scope.courseId };
                $http(config).then(function (promiseValue) {
                    var competences = promiseValue.data;
                    var dictionary = {};
                    competences.push(competence);
                    dictionary[competence.id] = competence;
                    for (var i = 0, len = competences.length - 1; i < len; i++) {
                        var newComp = new ML.Models.Competence(competences[i].id, competences[i].name, dictionary[pid], []);
                        dictionary[competences[i].id] = newComp;
                    }
                    for (var i = 0, len = competences.length - 1; i < len; i++) {
                        var pid = competences[i].parent;
                        if (!pid)
                            pid = 0;
                        if (!dictionary[pid].children)
                            dictionary[pid].children = [];
                        dictionary[competences[i].id].parent = dictionary[pid];
                        dictionary[pid].children.push(dictionary[competences[i].id]);
                    }
                }, function (error) {
                });
                var evaluations = $scope.evaluations = [];
                config = { method: "GET", url: basePath + "queryDB.php?op=getEvaluation&id=" + $scope.courseId };
                $http(config).then(function (promiseValue) {
                    var evaluationsQuery = promiseValue.data;
                    for (var i = 0, len = evaluationsQuery.length; i < len; i++) {
                        evaluations.push(evaluationsQuery[i]);
                        config = { method: "GET", url: basePath + "queryDB.php?op=getCompetenceFromEvaluation&id=" + evaluationsQuery[i].id };
                        $http(config).then(function (promiseValue) {
                            var idPairs = promiseValue.data;
                            for (var j = 0, len = idPairs.length; j < len; j++) {
                                var checkButton = $("[eid='" + idPairs[j].eid + "']").filter("[cid='" + idPairs[j].id + "']")[0];
                                checkButton.checked = true;
                            }
                        });
                    }
                }, function (error) {
                });
                $scope.editName = this.editName;
                $scope.editDescription = this.editDescription;
                $scope.editUrl = this.editUrl;
                $scope.newEvaluation = function ($event) {
                    var config = {
                        method: "GET", url: basePath + "queryDB.php?op=createEvaluation&cid=" + $scope.courseId
                            + "&name=" + CreateCourseEvaluacionesController.EmptyEvaluationName
                            + "&description=" + CreateCourseEvaluacionesController.EmptyEvaluationDescription
                            + "&url=" + CreateCourseEvaluacionesController.EmptyEvaluationURL
                    };
                    $http(config).then(function (promiseValue) {
                        var compId = promiseValue.data[0].id;
                        evaluations.push(new ML.Models.Evaluation(compId, CreateCourseEvaluacionesController.EmptyEvaluationName, CreateCourseEvaluacionesController.EmptyEvaluationDescription, CreateCourseEvaluacionesController.EmptyEvaluationURL));
                    }, function (error) {
                    });
                };
                $scope.saveEvaluation = function (evaluation) {
                    var config = {
                        method: "GET", url: basePath + "queryDB.php?op=updateEvaluation&cid=" + $scope.courseId
                            + "&name=" + evaluation.name
                            + "&description=" + evaluation.description
                            + "&url=" + evaluation.url
                            + "&id=" + evaluation.id
                    };
                    $http(config).then(function (promiseValue) {
                    }, function (error) {
                    });
                };
                $scope.changeName = function ($event, evaluation) {
                    var enterKey = 13;
                    if ($event.keyCode == enterKey) {
                        if (!evaluation.name || evaluation.name == "") {
                            evaluation.name = CreateCourseEvaluacionesController.EmptyEvaluationName;
                        }
                        evaluation.editName = false;
                    }
                    $scope.saveEvaluation(evaluation);
                };
                $scope.changeDescription = function ($event, evaluation) {
                    var enterKey = 13;
                    if ($event.keyCode == enterKey) {
                        if (!evaluation.description || evaluation.description == "") {
                            evaluation.description = CreateCourseEvaluacionesController.EmptyEvaluationDescription;
                        }
                        evaluation.editDescription = false;
                    }
                    $scope.saveEvaluation(evaluation);
                };
                $scope.changeUrl = function ($event, evaluation) {
                    var enterKey = 13;
                    if ($event.keyCode == enterKey) {
                        if (!evaluation.url || evaluation.url == "") {
                            evaluation.url = CreateCourseEvaluacionesController.EmptyEvaluationURL;
                        }
                        evaluation.editUrl = false;
                    }
                    $scope.saveEvaluation(evaluation);
                };
                $scope.erase = function (evaluation) {
                    var evaluations = _this.scope.evaluations;
                    for (var i = 0, len = evaluations.length; i < len; i++) {
                        if (evaluations[i].id == evaluation.id) {
                            evaluations.splice(i, 1);
                            break;
                        }
                    }
                    var config = { method: "GET", url: basePath + "queryDB.php?op=deleteEvaluation&id=" + evaluation.id };
                    $http(config).then(function (promiseValue) {
                    }, function (error) {
                    });
                };
                $scope.linkCompetenceToEvaluation = function ($event, evaluation, competence) {
                    var op = "delete";
                    if ($event.target.checked) {
                        op = "create";
                    }
                    var config = { method: "GET", url: basePath + "queryDB.php?op=" + op + "EvaluationsFromCompetence&cid=" + competence.id + "&oid=" + evaluation.id };
                    $http(config).then(function (promiseValue) {
                    }, function (error) {
                    });
                };
                this.scope = $scope;
            }
            CreateCourseEvaluacionesController.prototype.editName = function ($event, evaluation) {
                evaluation.editName = true;
                //Super hack, we probably dont want this
                setTimeout(function () { $($($event.currentTarget)[0].parentNode).find('input')[0].focus(); }, 50);
            };
            CreateCourseEvaluacionesController.prototype.editDescription = function ($event, evaluation) {
                evaluation.editDescription = true;
                //Super hack, we probably dont want this
                setTimeout(function () { $($($event.currentTarget)[0].parentNode).find('input')[0].focus(); }, 50);
            };
            CreateCourseEvaluacionesController.prototype.editUrl = function ($event, evaluation) {
                evaluation.editUrl = true;
                //Super hack, we probably dont want this
                setTimeout(function () { $($($event.currentTarget)[0].parentNode).find('input')[0].focus(); }, 50);
            };
            CreateCourseEvaluacionesController.EmptyEvaluationDescription = "Descripción vacía";
            CreateCourseEvaluacionesController.EmptyEvaluationName = "Nombre vacío";
            CreateCourseEvaluacionesController.EmptyEvaluationURL = "URL vacío";
            return CreateCourseEvaluacionesController;
        })();
        Controllers.CreateCourseEvaluacionesController = CreateCourseEvaluacionesController;
    })(Controllers = ML.Controllers || (ML.Controllers = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Controllers;
    (function (Controllers) {
        var CreateCourseInteraccionesController = (function () {
            function CreateCourseInteraccionesController($scope, $http) {
                var _this = this;
                var competence = $scope.competence = new ML.Models.Competence(0, "", null, []);
                var config = { method: "GET", url: basePath + "queryDB.php?op=getCompetence&id=" + $scope.courseId };
                $http(config).then(function (promiseValue) {
                    var competences = promiseValue.data;
                    var dictionary = {};
                    competences.push(competence);
                    dictionary[competence.id] = competence;
                    for (var i = 0, len = competences.length - 1; i < len; i++) {
                        var newComp = new ML.Models.Competence(competences[i].id, competences[i].name, dictionary[pid], []);
                        dictionary[competences[i].id] = newComp;
                    }
                    for (var i = 0, len = competences.length - 1; i < len; i++) {
                        var pid = competences[i].parent;
                        if (!pid)
                            pid = 0;
                        if (!dictionary[pid].children)
                            dictionary[pid].children = [];
                        dictionary[competences[i].id].parent = dictionary[pid];
                        dictionary[pid].children.push(dictionary[competences[i].id]);
                    }
                }, function (error) {
                });
                var interactions = $scope.interactions = [];
                config = { method: "GET", url: basePath + "queryDB.php?op=getInteraction&id=" + $scope.courseId };
                $http(config).then(function (promiseValue) {
                    var interactionsQuery = promiseValue.data;
                    for (var i = 0, len = interactionsQuery.length; i < len; i++) {
                        interactions.push(interactionsQuery[i]);
                        config = { method: "GET", url: basePath + "queryDB.php?op=getCompetenceFromInteraction&id=" + interactionsQuery[i].id };
                        $http(config).then(function (promiseValue) {
                            var idPairs = promiseValue.data;
                            for (var j = 0, len = idPairs.length; j < len; j++) {
                                var checkButton = $("[iid='" + idPairs[j].iid + "']").filter("[cid='" + idPairs[j].id + "']")[0];
                                checkButton.checked = true;
                            }
                        });
                    }
                }, function (error) {
                });
                $scope.editName = this.editName;
                $scope.editDescription = this.editDescription;
                $scope.newInteraction = function ($event) {
                    var config = {
                        method: "GET", url: basePath + "queryDB.php?op=createInteraction&cid=" + $scope.courseId
                            + "&name=" + CreateCourseInteraccionesController.EmptyInteractionName
                            + "&description=" + CreateCourseInteraccionesController.EmptyInteractionDescription
                    };
                    $http(config).then(function (promiseValue) {
                        var compId = promiseValue.data[0].id;
                        interactions.push(new ML.Models.Interaction(compId, CreateCourseInteraccionesController.EmptyInteractionName, CreateCourseInteraccionesController.EmptyInteractionDescription));
                    }, function (error) {
                    });
                };
                $scope.saveInteraction = function (interaction) {
                    var config = {
                        method: "GET", url: basePath + "queryDB.php?op=updateInteraction&cid=" + $scope.courseId
                            + "&name=" + interaction.name
                            + "&description=" + interaction.description
                            + "&id=" + interaction.id
                    };
                    $http(config).then(function (promiseValue) {
                    }, function (error) {
                    });
                };
                $scope.changeName = function ($event, interaction) {
                    var enterKey = 13;
                    if ($event.keyCode == enterKey) {
                        if (interaction.name == "") {
                            interaction.name = CreateCourseInteraccionesController.EmptyInteractionName;
                        }
                        interaction.editName = false;
                    }
                    $scope.saveInteraction(interaction);
                };
                $scope.changeDescription = function ($event, interaction) {
                    var enterKey = 13;
                    if ($event.keyCode == enterKey) {
                        if (interaction.description == "") {
                            interaction.description = CreateCourseInteraccionesController.EmptyInteractionDescription;
                        }
                        interaction.editDescription = false;
                    }
                    $scope.saveInteraction(interaction);
                };
                $scope.erase = function (interaction) {
                    var interactions = _this.scope.interactions;
                    for (var i = 0, len = interactions.length; i < len; i++) {
                        if (interactions[i].id == interaction.id) {
                            interactions.splice(i, 1);
                            break;
                        }
                    }
                    var config = { method: "GET", url: basePath + "queryDB.php?op=deleteInteraction&id=" + interaction.id };
                    $http(config).then(function (promiseValue) {
                    }, function (error) {
                    });
                };
                $scope.linkCompetenceToInteraction = function ($event, interaction, competence) {
                    var op = "delete";
                    if ($event.target.checked) {
                        op = "create";
                    }
                    var config = { method: "GET", url: basePath + "queryDB.php?op=" + op + "InteractionsFromCompetence&cid=" + competence.id + "&oid=" + interaction.id };
                    $http(config).then(function (promiseValue) {
                    }, function (error) {
                    });
                };
                this.scope = $scope;
            }
            CreateCourseInteraccionesController.prototype.editName = function ($event, interaction) {
                interaction.editName = true;
                //Super hack, we probably dont want this
                setTimeout(function () { $($($event.currentTarget)[0].parentNode).find('input')[0].focus(); }, 50);
            };
            CreateCourseInteraccionesController.prototype.editDescription = function ($event, interaction) {
                interaction.editDescription = true;
                //Super hack, we probably dont want this
                setTimeout(function () { $($($event.currentTarget)[0].parentNode).find('input')[0].focus(); }, 50);
            };
            CreateCourseInteraccionesController.EmptyInteractionDescription = 'Descripción vacía';
            CreateCourseInteraccionesController.EmptyInteractionName = 'Nombre vacío';
            return CreateCourseInteraccionesController;
        })();
        Controllers.CreateCourseInteraccionesController = CreateCourseInteraccionesController;
    })(Controllers = ML.Controllers || (ML.Controllers = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Controllers;
    (function (Controllers) {
        var CreateCourseNivelesController = (function () {
            function CreateCourseNivelesController($scope, $http) {
                var _this = this;
                var competence = $scope.competence = new ML.Models.Competence(0, "", null, []);
                var config = { method: "GET", url: basePath + "queryDB.php?op=getCompetence&id=" + $scope.courseId };
                $http(config).then(function (promiseValue) {
                    var competences = promiseValue.data;
                    var dictionary = {};
                    competences.push(competence);
                    dictionary[competence.id] = competence;
                    for (var i = 0, len = competences.length - 1; i < len; i++) {
                        var newComp = new ML.Models.Competence(competences[i].id, competences[i].name, dictionary[pid], []);
                        dictionary[competences[i].id] = newComp;
                    }
                    for (var i = 0, len = competences.length - 1; i < len; i++) {
                        var pid = competences[i].parent;
                        if (!pid)
                            pid = 0;
                        if (!dictionary[pid].children)
                            dictionary[pid].children = [];
                        dictionary[competences[i].id].parent = dictionary[pid];
                        dictionary[pid].children.push(dictionary[competences[i].id]);
                    }
                }, function (error) {
                });
                var levels = $scope.levels = [];
                config = { method: "GET", url: basePath + "queryDB.php?op=getDomain&id=" + $scope.courseId };
                $http(config).then(function (promiseValue) {
                    var levelQuery = promiseValue.data;
                    for (var i = 0, len = levelQuery.length; i < len; i++) {
                        levels.push(levelQuery[i]);
                        config = { method: "GET", url: basePath + "queryDB.php?op=getCompetenceFromDomain&id=" + levelQuery[i].id };
                        $http(config).then(function (promiseValue) {
                            var idPairs = promiseValue.data;
                            for (var j = 0, len = idPairs.length; j < len; j++) {
                                var checkButton = $("[did='" + idPairs[j].did + "']").filter("[cid='" + idPairs[j].id + "']")[0];
                                checkButton.checked = true;
                            }
                        });
                    }
                }, function (error) {
                });
                $scope.editName = this.editName;
                $scope.editDescription = this.editDescription;
                $scope.newLevel = function ($event) {
                    var config = {
                        method: "GET", url: basePath + "queryDB.php?op=createDomain&cid=" + $scope.courseId
                            + "&name=" + CreateCourseNivelesController.EmptyLevelName
                            + "&description=" + CreateCourseNivelesController.EmptyLevelDescription
                    };
                    $http(config).then(function (promiseValue) {
                        var compId = promiseValue.data[0].id;
                        levels.push(new ML.Models.Level(compId, CreateCourseNivelesController.EmptyLevelName, CreateCourseNivelesController.EmptyLevelDescription));
                    }, function (error) {
                    });
                };
                $scope.saveLevel = function (level) {
                    var config = {
                        method: "GET", url: basePath + "queryDB.php?op=updateDomain&cid=" + $scope.courseId
                            + "&name=" + level.name
                            + "&description=" + level.description
                            + "&id=" + level.id
                    };
                    $http(config).then(function (promiseValue) {
                    }, function (error) {
                    });
                };
                $scope.changeName = function ($event, level) {
                    var enterKey = 13;
                    if ($event.keyCode == enterKey) {
                        if (level.name == "") {
                            level.name = CreateCourseNivelesController.EmptyLevelName;
                        }
                        level.editName = false;
                    }
                    $scope.saveLevel(level);
                };
                $scope.changeDescription = function ($event, level) {
                    var enterKey = 13;
                    if ($event.keyCode == enterKey) {
                        if (level.description == "") {
                            level.description = CreateCourseNivelesController.EmptyLevelDescription;
                        }
                        level.editDescription = false;
                    }
                    $scope.saveLevel(level);
                };
                $scope.erase = function (level) {
                    var levels = _this.scope.levels;
                    for (var i = 0, len = levels.length; i < len; i++) {
                        if (levels[i].id == level.id) {
                            levels.splice(i, 1);
                            break;
                        }
                    }
                    var config = { method: "GET", url: basePath + "queryDB.php?op=deleteDomain&id=" + level.id };
                    $http(config).then(function (promiseValue) {
                    }, function (error) {
                    });
                };
                $scope.linkCompetenceToLevel = function ($event, level, competence) {
                    var op = "delete";
                    if ($event.target.checked) {
                        op = "create";
                    }
                    var config = { method: "GET", url: basePath + "queryDB.php?op=" + op + "DomainsFromCompetence&cid=" + competence.id + "&oid=" + level.id };
                    $http(config).then(function (promiseValue) {
                    }, function (error) {
                    });
                };
                this.scope = $scope;
            }
            CreateCourseNivelesController.prototype.editName = function ($event, level) {
                level.editName = true;
                //Super hack, we probably dont want this
                setTimeout(function () { $($($event.currentTarget)[0].parentNode).find('input')[0].focus(); }, 50);
            };
            CreateCourseNivelesController.prototype.editDescription = function ($event, level) {
                level.editDescription = true;
                //Super hack, we probably dont want this
                setTimeout(function () { $($($event.currentTarget)[0].parentNode).find('input')[0].focus(); }, 50);
            };
            CreateCourseNivelesController.EmptyLevelName = 'Nombre vacío';
            CreateCourseNivelesController.EmptyLevelDescription = 'Descripción vacía';
            return CreateCourseNivelesController;
        })();
        Controllers.CreateCourseNivelesController = CreateCourseNivelesController;
    })(Controllers = ML.Controllers || (ML.Controllers = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Controllers;
    (function (Controllers) {
        var CreateCourseReferenciasController = (function () {
            function CreateCourseReferenciasController($scope, $http) {
                var _this = this;
                var competence = $scope.competence = new ML.Models.Competence(0, "", null, []);
                var config = { method: "GET", url: basePath + "queryDB.php?op=getCompetence&id=" + $scope.courseId };
                $http(config).then(function (promiseValue) {
                    var competences = promiseValue.data;
                    var dictionary = {};
                    competences.push(competence);
                    dictionary[competence.id] = competence;
                    for (var i = 0, len = competences.length - 1; i < len; i++) {
                        var newComp = new ML.Models.Competence(competences[i].id, competences[i].name, dictionary[pid], []);
                        dictionary[competences[i].id] = newComp;
                    }
                    for (var i = 0, len = competences.length - 1; i < len; i++) {
                        var pid = competences[i].parent;
                        if (!pid)
                            pid = 0;
                        if (!dictionary[pid].children)
                            dictionary[pid].children = [];
                        dictionary[competences[i].id].parent = dictionary[pid];
                        dictionary[pid].children.push(dictionary[competences[i].id]);
                    }
                }, function (error) {
                });
                var references = $scope.references = [];
                config = { method: "GET", url: basePath + "queryDB.php?op=getResource&id=" + $scope.courseId };
                $http(config).then(function (promiseValue) {
                    var referencesQuery = promiseValue.data;
                    for (var i = 0, len = referencesQuery.length; i < len; i++) {
                        references.push(referencesQuery[i]);
                        config = { method: "GET", url: basePath + "queryDB.php?op=getCompetenceFromResource&id=" + referencesQuery[i].id };
                        $http(config).then(function (promiseValue) {
                            var idPairs = promiseValue.data;
                            for (var j = 0, len = idPairs.length; j < len; j++) {
                                var checkButton = $("[rid='" + idPairs[j].rid + "']").filter("[cid='" + idPairs[j].id + "']")[0];
                                checkButton.checked = true;
                            }
                        });
                    }
                }, function (error) {
                });
                $scope.editName = this.editName;
                $scope.editUrl = this.editUrl;
                $scope.editDescription = this.editDescription;
                $scope.newReference = function ($event) {
                    var config = {
                        method: "GET", url: basePath + "queryDB.php?op=createResource&cid=" + $scope.courseId
                            + "&name=" + CreateCourseReferenciasController.EmptyReferenceName
                            + "&description=" + CreateCourseReferenciasController.EmptyReferenceDescription
                            + "&url=" + CreateCourseReferenciasController.EmptyReferenceUrl
                    };
                    $http(config).then(function (promiseValue) {
                        var compId = promiseValue.data[0].id;
                        references.push(new ML.Models.Reference(compId, CreateCourseReferenciasController.EmptyReferenceName, CreateCourseReferenciasController.EmptyReferenceDescription, CreateCourseReferenciasController.EmptyReferenceUrl));
                    }, function (error) {
                    });
                };
                $scope.saveReference = function (reference) {
                    var config = {
                        method: "GET", url: basePath + "queryDB.php?op=updateResource&cid=" + $scope.courseId
                            + "&name=" + reference.name
                            + "&description=" + reference.description
                            + "&url=" + reference.url
                            + "&id=" + reference.id
                    };
                    $http(config).then(function (promiseValue) {
                    }, function (error) {
                    });
                };
                $scope.changeName = function ($event, reference) {
                    var enterKey = 13;
                    if ($event.keyCode == enterKey) {
                        if (reference.name == "") {
                            reference.name = CreateCourseReferenciasController.EmptyReferenceName;
                        }
                        reference.editName = false;
                    }
                    $scope.saveReference(reference);
                };
                $scope.changeDescription = function ($event, reference) {
                    var enterKey = 13;
                    if ($event.keyCode == enterKey) {
                        if (reference.description == "") {
                            reference.description = CreateCourseReferenciasController.EmptyReferenceDescription;
                        }
                        reference.editDescription = false;
                    }
                    $scope.saveReference(reference);
                };
                $scope.changeUrl = function ($event, reference) {
                    var enterKey = 13;
                    if ($event.keyCode == enterKey) {
                        if (reference.url == "") {
                            reference.url = CreateCourseReferenciasController.EmptyReferenceUrl;
                        }
                        reference.editUrl = false;
                    }
                    $scope.saveReference(reference);
                };
                $scope.erase = function (reference) {
                    var references = _this.scope.references;
                    for (var i = 0, len = references.length; i < len; i++) {
                        if (references[i].id == reference.id) {
                            references.splice(i, 1);
                            break;
                        }
                    }
                    var config = { method: "GET", url: basePath + "queryDB.php?op=deleteResource&id=" + reference.id };
                    $http(config).then(function (promiseValue) {
                    }, function (error) {
                    });
                };
                $scope.linkCompetenceToReference = function ($event, reference, competence) {
                    var op = "delete";
                    if ($event.target.checked) {
                        op = "create";
                    }
                    var config = { method: "GET", url: basePath + "queryDB.php?op=" + op + "ResourcesFromCompetence&cid=" + competence.id + "&oid=" + reference.id };
                    $http(config).then(function (promiseValue) {
                    }, function (error) {
                    });
                };
                this.scope = $scope;
            }
            CreateCourseReferenciasController.prototype.editName = function ($event, reference) {
                reference.editName = true;
                //Super hack, we probably dont want this
                setTimeout(function () { $($($event.currentTarget)[0].parentNode).find('input')[0].focus(); }, 50);
            };
            CreateCourseReferenciasController.prototype.editDescription = function ($event, reference) {
                reference.editDescription = true;
                //Super hack, we probably dont want this
                setTimeout(function () { $($($event.currentTarget)[0].parentNode).find('input')[0].focus(); }, 50);
            };
            CreateCourseReferenciasController.prototype.editUrl = function ($event, reference) {
                reference.editUrl = true;
                //Super hack, we probably dont want this
                setTimeout(function () { $($($event.currentTarget)[0].parentNode).find('input')[0].focus(); }, 50);
            };
            CreateCourseReferenciasController.EmptyReferenceDescription = 'Descripción vacía';
            CreateCourseReferenciasController.EmptyReferenceName = 'Nombre vacío';
            CreateCourseReferenciasController.EmptyReferenceUrl = 'URL vacío';
            return CreateCourseReferenciasController;
        })();
        Controllers.CreateCourseReferenciasController = CreateCourseReferenciasController;
    })(Controllers = ML.Controllers || (ML.Controllers = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Controllers;
    (function (Controllers) {
        var EvaluacionesController = (function () {
            function EvaluacionesController($scope, $http) {
                var evaluations = $scope.evaluations = [];
                var config = { method: "GET", url: basePath + "queryDB.php?op=getEvaluation&id=" + $scope.courseId };
                $http(config).then(function (promiseValue) {
                    var evaluationsQuery = promiseValue.data;
                    for (var i = 0, len = evaluationsQuery.length; i < len; i++) {
                        evaluations.push(evaluationsQuery[i]);
                    }
                }, function (error) {
                });
                this.scope = $scope;
            }
            return EvaluacionesController;
        })();
        Controllers.EvaluacionesController = EvaluacionesController;
    })(Controllers = ML.Controllers || (ML.Controllers = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Controllers;
    (function (Controllers) {
        var FilterCourseByCompetenceController = (function () {
            function FilterCourseByCompetenceController($scope, $http) {
                var config = { method: "GET", url: basePath + "queryDB.php?op=getCompetenceFromId&id=" + $scope.competenceId };
                $http(config).then(function (promiseValue) {
                    $scope.competence = promiseValue.data[0];
                }, function (error) {
                });
                var evaluations = $scope.evaluations = [];
                config = { method: "GET", url: basePath + "queryDB.php?op=getEvaluationsFromCompetence&id=" + $scope.competenceId };
                $http(config).then(function (promiseValue) {
                    var evaluationsQuery = promiseValue.data;
                    for (var i = 0, len = evaluationsQuery.length; i < len; i++) {
                        evaluations.push(evaluationsQuery[i]);
                    }
                }, function (error) {
                });
                var interactions = $scope.interactions = [];
                config = { method: "GET", url: basePath + "queryDB.php?op=getInteractionsFromCompetence&id=" + $scope.competenceId };
                $http(config).then(function (promiseValue) {
                    var interactionsQuery = promiseValue.data;
                    for (var i = 0, len = interactionsQuery.length; i < len; i++) {
                        interactions.push(interactionsQuery[i]);
                    }
                }, function (error) {
                });
                var levels = $scope.levels = [];
                config = { method: "GET", url: basePath + "queryDB.php?op=getDomainsFromCompetence&id=" + $scope.competenceId };
                $http(config).then(function (promiseValue) {
                    var levelQuery = promiseValue.data;
                    for (var i = 0, len = levelQuery.length; i < len; i++) {
                        levels.push(levelQuery[i]);
                    }
                }, function (error) {
                });
                var references = $scope.references = [];
                config = { method: "GET", url: basePath + "queryDB.php?op=getResourcesFromCompetence&id=" + $scope.competenceId };
                $http(config).then(function (promiseValue) {
                    var referencesQuery = promiseValue.data;
                    for (var i = 0, len = referencesQuery.length; i < len; i++) {
                        references.push(referencesQuery[i]);
                    }
                }, function (error) {
                });
                this.scope = $scope;
            }
            return FilterCourseByCompetenceController;
        })();
        Controllers.FilterCourseByCompetenceController = FilterCourseByCompetenceController;
    })(Controllers = ML.Controllers || (ML.Controllers = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Controllers;
    (function (Controllers) {
        var HomeController = (function () {
            function HomeController($scope, $http) {
                var _this = this;
                $scope.nodos = [];
                $scope.graph = function () {
                    var letters = '456789ABCDEF'.split('');
                    var width = document.getElementById('node-graph').offsetWidth, height = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
                    var nodes = [];
                    var queue = [];
                    var remaining = [];
                    var cutoff = 6;
                    nodes.push({
                        'id': $scope.nodos[0].id,
                        'name': $scope.nodos[0].name,
                        'group': 0,
                        'x': width / 2,
                        'y': height / 2
                    });
                    for (var i = 1; i < $scope.nodos.length; i++) {
                        if (i > cutoff) {
                            remaining.push($scope.nodos[i].id);
                        }
                        else {
                            queue.push($scope.nodos[i].id);
                        }
                        nodes.push({
                            'id': $scope.nodos[i].id,
                            'name': $scope.nodos[i].name,
                            'group': 0,
                            'x': width / 2,
                            'y': height / 2
                        });
                    }
                    var links = [];
                    while (queue.length > 0 && remaining.length > 0) {
                        var cnode = queue.shift();
                        var left = remaining.shift();
                        links.push({ 'source': cnode, 'target': left });
                        queue.push(left);
                        if (remaining.length > 0) {
                            var right = remaining.shift();
                            links.push({ 'source': cnode, 'target': right });
                            queue.push(right);
                        }
                    }
                    var force = d3.layout.force()
                        .nodes(nodes)
                        .links(links)
                        .charge(-1000)
                        .linkDistance(function (d, i) { return 175; })
                        .size([width, height])
                        .start();
                    var svg = d3.select('#node-graph').append('svg')
                        .attr('width', width)
                        .attr('height', height);
                    var container = svg.selectAll('g')
                        .data(nodes);
                    var cont = container.enter()
                        .append('g')
                        .attr('transform', function (d) { return 'translate(' + d.x + ',' + d.y + ')'; });
                    var anchor = cont.append('svg:a')
                        .attr('xlink:href', function (d) { return basePath + '#/courses/view/' + d.id; });
                    var node = anchor.append('circle')
                        .attr('r', 75)
                        .attr('fill', function (d) {
                        var color = '#';
                        for (var i = 0; i < 6; i++) {
                            color += letters[Math.floor(Math.random() * 12)];
                        }
                        return color;
                    });
                    var text = anchor.append('text')
                        .attr('dx', function (d) { return -20; })
                        .text(function (d) { return d.name; });
                    force.on('tick', function () {
                        cont.attr('transform', function (d) { return 'translate(' + d.x + ',' + d.y + ')'; });
                    });
                };
                this.scope = $scope;
                var config = { method: 'GET', url: basePath + 'queryDB.php?op=getCourses' };
                $http(config).then(function (promiseValue) {
                    var courses = promiseValue.data;
                    for (var i = 0, len = courses.length; i < len; i++) {
                        _this.scope.nodos.push(courses[i]);
                    }
                    _this.scope.graph();
                }, function (error) {
                });
            }
            return HomeController;
        })();
        Controllers.HomeController = HomeController;
    })(Controllers = ML.Controllers || (ML.Controllers = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Controllers;
    (function (Controllers) {
        var InteraccionesController = (function () {
            function InteraccionesController($scope, $http) {
                var interactions = $scope.interactions = [];
                var config = { method: "GET", url: basePath + "queryDB.php?op=getInteraction&id=" + $scope.courseId };
                $http(config).then(function (promiseValue) {
                    var interactionsQuery = promiseValue.data;
                    for (var i = 0, len = interactionsQuery.length; i < len; i++) {
                        interactions.push(interactionsQuery[i]);
                    }
                }, function (error) {
                });
                this.scope = $scope;
            }
            return InteraccionesController;
        })();
        Controllers.InteraccionesController = InteraccionesController;
    })(Controllers = ML.Controllers || (ML.Controllers = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Controllers;
    (function (Controllers) {
        var LoginController = (function () {
            function LoginController($scope, $rootScope, $http) {
                $scope.login = function () {
                    var config = {
                        method: 'POST',
                        url: basePath + 'queryDB.php?op=login',
                        data: {
                            'username': $scope.credentials.username,
                            'password': $scope.credentials.password
                        }
                    };
                    $http(config)
                        .then(function (promiseValue) {
                        var user = promiseValue.data;
                        $rootScope.user = user.id;
                    }, function (error) {
                        alert('Credenciales Invalidas');
                    });
                };
                this.scope = $scope;
            }
            return LoginController;
        })();
        Controllers.LoginController = LoginController;
    })(Controllers = ML.Controllers || (ML.Controllers = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Controllers;
    (function (Controllers) {
        var NavBarController = (function () {
            function NavBarController($scope) {
                this.scope = $scope;
            }
            return NavBarController;
        })();
        Controllers.NavBarController = NavBarController;
    })(Controllers = ML.Controllers || (ML.Controllers = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Controllers;
    (function (Controllers) {
        var NivelesController = (function () {
            function NivelesController($scope, $http) {
                var levels = $scope.levels = [];
                var config = { method: "GET", url: basePath + "queryDB.php?op=getDomain&id=" + $scope.courseId };
                $http(config).then(function (promiseValue) {
                    var levelQuery = promiseValue.data;
                    for (var i = 0, len = levelQuery.length; i < len; i++) {
                        levels.push(levelQuery[i]);
                    }
                }, function (error) {
                });
                this.scope = $scope;
            }
            return NivelesController;
        })();
        Controllers.NivelesController = NivelesController;
    })(Controllers = ML.Controllers || (ML.Controllers = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Controllers;
    (function (Controllers) {
        var ProfCoursesController = (function () {
            function ProfCoursesController($scope, $http) {
                var courses = $scope.courses = [];
                var config = { method: 'GET', url: basePath + 'queryDB.php?op=getCourses' };
                $http(config).then(function (promiseValue) {
                    var coursesQuery = promiseValue.data;
                    for (var i = 0, len = coursesQuery.length; i < len; i++) {
                        courses.push(coursesQuery[i]);
                    }
                }, function (error) {
                });
                $scope.addCourse = function () {
                    var config = { method: 'GET', url: basePath + 'queryDB.php?op=createCourse&name=' + ProfCoursesController.EmptyCourseName + "&description=" + ProfCoursesController.EmptyCourseDescription };
                    $http(config).then(function (promiseValue) {
                        var id = promiseValue.data[0].id;
                        courses.push(new ML.Models.Course(id, ProfCoursesController.EmptyCourseName, ProfCoursesController.EmptyCourseDescription));
                    }, function (error) {
                    });
                };
                $scope.erase = function (course) {
                    for (var i = 0, len = courses.length; i < len; i++) {
                        if (courses[i].id == course.id) {
                            courses.splice(i, 1);
                            break;
                        }
                    }
                    var config = { method: 'GET', url: basePath + 'queryDB.php?op=deleteCourse&id=' + course.id };
                    $http(config).then(function (promiseValue) {
                    }, function (error) {
                    });
                };
                this.scope = $scope;
            }
            ProfCoursesController.EmptyCourseName = "Curso sin nombre";
            ProfCoursesController.EmptyCourseDescription = "Curso sin descripción";
            return ProfCoursesController;
        })();
        Controllers.ProfCoursesController = ProfCoursesController;
    })(Controllers = ML.Controllers || (ML.Controllers = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Controllers;
    (function (Controllers) {
        var ReferenciasController = (function () {
            function ReferenciasController($scope, $http) {
                var references = $scope.references = [];
                var config = { method: "GET", url: basePath + "queryDB.php?op=getResource&id=" + $scope.courseId };
                $http(config).then(function (promiseValue) {
                    var referencesQuery = promiseValue.data;
                    for (var i = 0, len = referencesQuery.length; i < len; i++) {
                        references.push(referencesQuery[i]);
                    }
                }, function (error) {
                });
                this.scope = $scope;
            }
            return ReferenciasController;
        })();
        Controllers.ReferenciasController = ReferenciasController;
    })(Controllers = ML.Controllers || (ML.Controllers = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Controllers;
    (function (Controllers) {
        var SideBarController = (function () {
            function SideBarController($scope) {
                this.scope = $scope;
            }
            return SideBarController;
        })();
        Controllers.SideBarController = SideBarController;
    })(Controllers = ML.Controllers || (ML.Controllers = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Controllers;
    (function (Controllers) {
        var StudCoursesController = (function () {
            function StudCoursesController($scope, $http) {
                $scope.nodos = [];
                $scope.nodos.push(new ML.Models.Course(2, 'Aleman 1', 'Curso impartido por Yara Iruegas.'));
                this.scope = $scope;
            }
            return StudCoursesController;
        })();
        Controllers.StudCoursesController = StudCoursesController;
    })(Controllers = ML.Controllers || (ML.Controllers = {}));
})(ML || (ML = {}));
// parciales
appModule.controller('navBarController', ['$scope', function ($scope) { return new ML.Controllers.NavBarController($scope); }]);
appModule.controller('sideBarController', ['$scope', function ($scope) { return new ML.Controllers.SideBarController($scope); }]);
// nodos
appModule.controller('homeController', ['$scope', '$http', function ($scope, $http) { return new ML.Controllers.HomeController($scope, $http); }]);
appModule.controller('loginController', ['$scope', '$rootScope', '$http', function ($scope, $rootScope, $http) { return new ML.Controllers.LoginController($scope, $rootScope, $http); }]);
appModule.controller('profCoursesController', ['$scope', '$http', function ($scope, $http) { return new ML.Controllers.ProfCoursesController($scope, $http); }]);
appModule.controller('courseDetailController', ['$scope', '$http', function ($scope, $http) { return new ML.Controllers.CourseDetailController($scope, $http); }]);
// crear curso
appModule.controller('createCourseController', ['$scope', '$http', function ($scope, $http) { return new ML.Controllers.CreateCourseController($scope, $http); }]);
appModule.controller('createCourseCompetenciasController', ['$scope', '$http', function ($scope, $http) { return new ML.Controllers.CreateCourseCompetenciasController($scope, $http); }]);
appModule.controller('createCourseEvaluacionesController', ['$scope', '$http', function ($scope, $http) { return new ML.Controllers.CreateCourseEvaluacionesController($scope, $http); }]);
appModule.controller('createCourseInteraccionesController', ['$scope', '$http', function ($scope, $http) { return new ML.Controllers.CreateCourseInteraccionesController($scope, $http); }]);
appModule.controller('createCourseNivelesController', ['$scope', '$http', function ($scope, $http) { return new ML.Controllers.CreateCourseNivelesController($scope, $http); }]);
appModule.controller('createCourseReferenciasController', ['$scope', '$http', function ($scope, $http) { return new ML.Controllers.CreateCourseReferenciasController($scope, $http); }]);
// ver curso
appModule.controller('courseController', ['$scope', '$http', function ($scope, $http) { return new ML.Controllers.CourseController($scope, $http); }]);
appModule.controller('competenciasController', ['$scope', '$http', function ($scope, $http) { return new ML.Controllers.CompetenciasController($scope, $http); }]);
appModule.controller('filterCourseByCompetenceController', ['$scope', '$http', function ($scope, $http) { return new ML.Controllers.FilterCourseByCompetenceController($scope, $http); }]);
appModule.controller('evaluacionesController', ['$scope', '$http', function ($scope, $http) { return new ML.Controllers.EvaluacionesController($scope, $http); }]);
appModule.controller('interaccionesController', ['$scope', '$http', function ($scope, $http) { return new ML.Controllers.InteraccionesController($scope, $http); }]);
appModule.controller('nivelesController', ['$scope', '$http', function ($scope, $http) { return new ML.Controllers.NivelesController($scope, $http); }]);
appModule.controller('referenciasController', ['$scope', '$http', function ($scope, $http) { return new ML.Controllers.ReferenciasController($scope, $http); }]);
var ML;
(function (ML) {
    var Directives;
    (function (Directives) {
        var Competencias = (function () {
            function Competencias() {
                return this.createDirective();
            }
            Competencias.prototype.createDirective = function () {
                return {
                    controller: ML.Controllers.CompetenciasController,
                    restrict: 'E',
                    templateUrl: basePath + 'views/competencias.html',
                    replace: true,
                    scope: {
                        courseId: "=",
                    }
                };
            };
            return Competencias;
        })();
        Directives.Competencias = Competencias;
    })(Directives = ML.Directives || (ML.Directives = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Directives;
    (function (Directives) {
        var Course = (function () {
            function Course() {
                return this.createDirective();
            }
            Course.prototype.createDirective = function () {
                return {
                    controller: ML.Controllers.CourseController,
                    restrict: 'E',
                    templateUrl: basePath + 'views/course.html',
                    replace: true,
                    scope: {
                        // Es importante notar que si no ponemos scope tendra un shared scope con su padre (en vez de uno propio)
                        courseId: "="
                    }
                };
            };
            return Course;
        })();
        Directives.Course = Course;
    })(Directives = ML.Directives || (ML.Directives = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Directives;
    (function (Directives) {
        var CourseDetail = (function () {
            function CourseDetail() {
                return this.createDirective();
            }
            CourseDetail.prototype.createDirective = function () {
                return {
                    controller: ML.Controllers.CourseDetailController,
                    restrict: 'E',
                    templateUrl: basePath + 'views/course_detail.html',
                    replace: true,
                    scope: {
                        // Es importante notar que si no ponemos scope tendra un shared scope con su padre (en vez de uno propio)
                        courseId: "=",
                    },
                    link: function (scope, element, attrs) {
                        element.find('.back-button').on('click', function () {
                            window.history.back();
                        });
                    }
                };
            };
            return CourseDetail;
        })();
        Directives.CourseDetail = CourseDetail;
    })(Directives = ML.Directives || (ML.Directives = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Directives;
    (function (Directives) {
        var CreateCourse = (function () {
            function CreateCourse() {
                return this.createDirective();
            }
            CreateCourse.prototype.createDirective = function () {
                return {
                    controller: ML.Controllers.CreateCourseController,
                    restrict: 'E',
                    templateUrl: basePath + 'views/create_course.html',
                    replace: true,
                    scope: {
                        courseId: "=",
                    }
                };
            };
            return CreateCourse;
        })();
        Directives.CreateCourse = CreateCourse;
    })(Directives = ML.Directives || (ML.Directives = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Directives;
    (function (Directives) {
        var CreateCourseCompetencias = (function () {
            function CreateCourseCompetencias() {
                return this.createDirective();
            }
            CreateCourseCompetencias.prototype.createDirective = function () {
                return {
                    controller: ML.Controllers.CreateCourseCompetenciasController,
                    restrict: 'E',
                    templateUrl: basePath + 'views/create_course_competencias.html',
                    replace: true,
                    scope: {
                        courseId: "=",
                    }
                };
            };
            return CreateCourseCompetencias;
        })();
        Directives.CreateCourseCompetencias = CreateCourseCompetencias;
    })(Directives = ML.Directives || (ML.Directives = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Directives;
    (function (Directives) {
        var CreateCourseEvaluaciones = (function () {
            function CreateCourseEvaluaciones() {
                return this.createDirective();
            }
            CreateCourseEvaluaciones.prototype.createDirective = function () {
                return {
                    controller: ML.Controllers.CreateCourseEvaluacionesController,
                    restrict: 'E',
                    templateUrl: basePath + 'views/create_course_evaluaciones.html',
                    replace: true,
                    scope: {
                        courseId: "=",
                    }
                };
            };
            return CreateCourseEvaluaciones;
        })();
        Directives.CreateCourseEvaluaciones = CreateCourseEvaluaciones;
    })(Directives = ML.Directives || (ML.Directives = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Directives;
    (function (Directives) {
        var CreateCourseInteracciones = (function () {
            function CreateCourseInteracciones() {
                return this.createDirective();
            }
            CreateCourseInteracciones.prototype.createDirective = function () {
                return {
                    controller: ML.Controllers.CreateCourseInteraccionesController,
                    restrict: 'E',
                    templateUrl: basePath + 'views/create_course_interacciones.html',
                    replace: true,
                    scope: {
                        courseId: "=",
                    }
                };
            };
            return CreateCourseInteracciones;
        })();
        Directives.CreateCourseInteracciones = CreateCourseInteracciones;
    })(Directives = ML.Directives || (ML.Directives = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Directives;
    (function (Directives) {
        var CreateCourseNiveles = (function () {
            function CreateCourseNiveles() {
                return this.createDirective();
            }
            CreateCourseNiveles.prototype.createDirective = function () {
                return {
                    controller: ML.Controllers.CreateCourseNivelesController,
                    restrict: 'E',
                    templateUrl: basePath + 'views/create_course_niveles.html',
                    replace: true,
                    scope: {
                        courseId: "=",
                    }
                };
            };
            return CreateCourseNiveles;
        })();
        Directives.CreateCourseNiveles = CreateCourseNiveles;
    })(Directives = ML.Directives || (ML.Directives = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Directives;
    (function (Directives) {
        var CreateCourseReferencias = (function () {
            function CreateCourseReferencias() {
                return this.createDirective();
            }
            CreateCourseReferencias.prototype.createDirective = function () {
                return {
                    controller: ML.Controllers.CreateCourseReferenciasController,
                    restrict: 'E',
                    templateUrl: basePath + 'views/create_course_referencias.html',
                    replace: true,
                    scope: {
                        courseId: "=",
                    }
                };
            };
            return CreateCourseReferencias;
        })();
        Directives.CreateCourseReferencias = CreateCourseReferencias;
    })(Directives = ML.Directives || (ML.Directives = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Directives;
    (function (Directives) {
        var Evaluaciones = (function () {
            function Evaluaciones() {
                return this.createDirective();
            }
            Evaluaciones.prototype.createDirective = function () {
                return {
                    controller: ML.Controllers.EvaluacionesController,
                    restrict: 'E',
                    templateUrl: basePath + 'views/evaluaciones.html',
                    replace: true,
                    scope: {
                        courseId: "="
                    }
                };
            };
            return Evaluaciones;
        })();
        Directives.Evaluaciones = Evaluaciones;
    })(Directives = ML.Directives || (ML.Directives = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Directives;
    (function (Directives) {
        var FilterCourseByCompetence = (function () {
            function FilterCourseByCompetence() {
                return this.createDirective();
            }
            FilterCourseByCompetence.prototype.createDirective = function () {
                return {
                    controller: ML.Controllers.FilterCourseByCompetenceController,
                    restrict: 'E',
                    templateUrl: basePath + 'views/filterCourseByCompetence.html',
                    replace: true,
                    scope: {
                        // Es importante notar que si no ponemos scope tendra un shared scope con su padre (en vez de uno propio)
                        courseId: "=",
                        competenceId: "="
                    }
                };
            };
            return FilterCourseByCompetence;
        })();
        Directives.FilterCourseByCompetence = FilterCourseByCompetence;
    })(Directives = ML.Directives || (ML.Directives = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Directives;
    (function (Directives) {
        var Home = (function () {
            function Home() {
                return this.createDirective();
            }
            Home.prototype.createDirective = function () {
                return {
                    controller: ML.Controllers.HomeController,
                    restrict: 'E',
                    templateUrl: basePath + 'views/home.html',
                    replace: true,
                    scope: {}
                };
            };
            return Home;
        })();
        Directives.Home = Home;
    })(Directives = ML.Directives || (ML.Directives = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Directives;
    (function (Directives) {
        var Interacciones = (function () {
            function Interacciones() {
                return this.createDirective();
            }
            Interacciones.prototype.createDirective = function () {
                return {
                    controller: ML.Controllers.InteraccionesController,
                    restrict: 'E',
                    templateUrl: basePath + 'views/interacciones.html',
                    replace: true,
                    scope: {
                        courseId: "="
                    }
                };
            };
            return Interacciones;
        })();
        Directives.Interacciones = Interacciones;
    })(Directives = ML.Directives || (ML.Directives = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Directives;
    (function (Directives) {
        var Login = (function () {
            function Login() {
                return this.createDirective();
            }
            Login.prototype.createDirective = function () {
                return {
                    controller: ML.Controllers.LoginController,
                    restrict: 'E',
                    templateUrl: basePath + 'views/login.html',
                    replace: true,
                    scope: {}
                };
            };
            return Login;
        })();
        Directives.Login = Login;
    })(Directives = ML.Directives || (ML.Directives = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Directives;
    (function (Directives) {
        var NavBar = (function () {
            function NavBar() {
                return this.createDirective();
            }
            NavBar.prototype.createDirective = function () {
                return {
                    controller: ML.Controllers.NavBarController,
                    restrict: 'E',
                    templateUrl: basePath + 'views/navBar.html',
                    replace: true,
                    scope: {}
                };
            };
            return NavBar;
        })();
        Directives.NavBar = NavBar;
    })(Directives = ML.Directives || (ML.Directives = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Directives;
    (function (Directives) {
        var Niveles = (function () {
            function Niveles() {
                return this.createDirective();
            }
            Niveles.prototype.createDirective = function () {
                return {
                    controller: ML.Controllers.NivelesController,
                    restrict: 'E',
                    templateUrl: basePath + 'views/niveles.html',
                    replace: true,
                    scope: {
                        courseId: "="
                    }
                };
            };
            return Niveles;
        })();
        Directives.Niveles = Niveles;
    })(Directives = ML.Directives || (ML.Directives = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Directives;
    (function (Directives) {
        var ProfCourses = (function () {
            function ProfCourses() {
                return this.createDirective();
            }
            ProfCourses.prototype.createDirective = function () {
                return {
                    controller: ML.Controllers.ProfCoursesController,
                    restrict: 'E',
                    templateUrl: basePath + 'views/prof_courses.html',
                    replace: true,
                    scope: {}
                };
            };
            return ProfCourses;
        })();
        Directives.ProfCourses = ProfCourses;
    })(Directives = ML.Directives || (ML.Directives = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Directives;
    (function (Directives) {
        var Referencias = (function () {
            function Referencias() {
                return this.createDirective();
            }
            Referencias.prototype.createDirective = function () {
                return {
                    controller: ML.Controllers.ReferenciasController,
                    restrict: 'E',
                    templateUrl: basePath + 'views/referencias.html',
                    replace: true,
                    scope: {
                        courseId: "="
                    }
                };
            };
            return Referencias;
        })();
        Directives.Referencias = Referencias;
    })(Directives = ML.Directives || (ML.Directives = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Directives;
    (function (Directives) {
        var SideBar = (function () {
            function SideBar() {
                return this.createDirective();
            }
            SideBar.prototype.createDirective = function () {
                return {
                    controller: ML.Controllers.SideBarController,
                    restrict: 'E',
                    templateUrl: basePath + 'views/sideBar.html',
                    replace: true,
                    scope: {}
                };
            };
            return SideBar;
        })();
        Directives.SideBar = SideBar;
    })(Directives = ML.Directives || (ML.Directives = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Directives;
    (function (Directives) {
        var StudCourses = (function () {
            function StudCourses() {
                return this.createDirective();
            }
            StudCourses.prototype.createDirective = function () {
                return {
                    controller: ML.Controllers.StudCoursesController,
                    restrict: 'E',
                    templateUrl: basePath + 'views/stud_courses.html',
                    replace: true,
                    scope: {}
                };
            };
            return StudCourses;
        })();
        Directives.StudCourses = StudCourses;
    })(Directives = ML.Directives || (ML.Directives = {}));
})(ML || (ML = {}));
// parciales
appModule.directive('navBar', function () { return new ML.Directives.NavBar(); });
appModule.directive('sideBar', function () { return new ML.Directives.SideBar(); });
// nodos
appModule.directive('home', function () { return new ML.Directives.Home(); });
appModule.directive('login', function () { return new ML.Directives.Login(); });
appModule.directive('studCourses', function () { return new ML.Directives.StudCourses(); });
appModule.directive('profCourses', function () { return new ML.Directives.ProfCourses(); });
appModule.directive('courseDetail', function () { return new ML.Directives.CourseDetail(); });
// crear curso
appModule.directive('createCourse', function () { return new ML.Directives.CreateCourse(); });
appModule.directive('createCourseCompetencias', function () { return new ML.Directives.CreateCourseCompetencias(); });
appModule.directive('createCourseEvaluaciones', function () { return new ML.Directives.CreateCourseEvaluaciones(); });
appModule.directive('createCourseInteracciones', function () { return new ML.Directives.CreateCourseInteracciones(); });
appModule.directive('createCourseNiveles', function () { return new ML.Directives.CreateCourseNiveles(); });
appModule.directive('createCourseReferencias', function () { return new ML.Directives.CreateCourseReferencias(); });
// ver curso
appModule.directive('course', function () { return new ML.Directives.Course(); });
appModule.directive('filterCourseByCompetence', function () { return new ML.Directives.FilterCourseByCompetence(); });
appModule.directive('competencias', function () { return new ML.Directives.Competencias(); });
appModule.directive('evaluaciones', function () { return new ML.Directives.Evaluaciones(); });
appModule.directive('interacciones', function () { return new ML.Directives.Interacciones(); });
appModule.directive('niveles', function () { return new ML.Directives.Niveles(); });
appModule.directive('referencias', function () { return new ML.Directives.Referencias(); });
var ML;
(function (ML) {
    var Models;
    (function (Models) {
        var Competence = (function () {
            function Competence(id, description, parent, children, edit) {
                if (edit === void 0) { edit = false; }
                this.id = id;
                this.name = description;
                this.parent = parent;
                this.children = children;
                this.edit = edit;
            }
            return Competence;
        })();
        Models.Competence = Competence;
    })(Models = ML.Models || (ML.Models = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Models;
    (function (Models) {
        var Course = (function () {
            function Course(id, name, description) {
                this.id = id;
                this.name = name;
                this.description = description;
            }
            return Course;
        })();
        Models.Course = Course;
    })(Models = ML.Models || (ML.Models = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Models;
    (function (Models) {
        var Credentials = (function () {
            function Credentials(username, password) {
                this.username = username;
                this.password = password;
            }
            return Credentials;
        })();
        Models.Credentials = Credentials;
    })(Models = ML.Models || (ML.Models = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Models;
    (function (Models) {
        var Evaluation = (function () {
            function Evaluation(id, name, description, url, editName, editDescription, editUrl) {
                if (editName === void 0) { editName = false; }
                if (editDescription === void 0) { editDescription = false; }
                if (editUrl === void 0) { editUrl = false; }
                this.id = id;
                this.name = name;
                this.description = description;
                this.url = url;
                this.editName = editName;
                this.editDescription = editDescription;
                this.editUrl = editUrl;
            }
            return Evaluation;
        })();
        Models.Evaluation = Evaluation;
    })(Models = ML.Models || (ML.Models = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Models;
    (function (Models) {
        var Interaction = (function () {
            function Interaction(id, name, description, editName, editDescription) {
                if (editName === void 0) { editName = false; }
                if (editDescription === void 0) { editDescription = false; }
                this.id = id;
                this.name = name;
                this.description = description;
                this.editName = editName;
                this.editDescription = editDescription;
            }
            return Interaction;
        })();
        Models.Interaction = Interaction;
    })(Models = ML.Models || (ML.Models = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Models;
    (function (Models) {
        var Level = (function () {
            function Level(id, name, description, editName, editDescription) {
                if (editName === void 0) { editName = false; }
                if (editDescription === void 0) { editDescription = false; }
                this.id = id;
                this.name = name;
                this.description = description;
                this.editName = editName;
                this.editDescription = editDescription;
            }
            return Level;
        })();
        Models.Level = Level;
    })(Models = ML.Models || (ML.Models = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Models;
    (function (Models) {
        var Reference = (function () {
            function Reference(id, name, description, url, editName, editDescription, editUrl) {
                if (editName === void 0) { editName = false; }
                if (editDescription === void 0) { editDescription = false; }
                if (editUrl === void 0) { editUrl = false; }
                this.id = id;
                this.name = name;
                this.description = description;
                this.url = url;
                this.editName = editName;
                this.editDescription = editDescription;
                this.editUrl = editUrl;
            }
            return Reference;
        })();
        Models.Reference = Reference;
    })(Models = ML.Models || (ML.Models = {}));
})(ML || (ML = {}));
var ML;
(function (ML) {
    var Models;
    (function (Models) {
        var User = (function () {
            function User(id) {
                this.id = id;
            }
            return User;
        })();
        Models.User = User;
    })(Models = ML.Models || (ML.Models = {}));
})(ML || (ML = {}));
appModule.config(function ($stateProvider, $urlRouterProvider) {
    $urlRouterProvider.otherwise('/');
    $stateProvider
        .state('index', {
        url: '/',
        template: '<home></home>'
    })
        .state('auth', {
        url: '/auth',
        template: '<login></login>'
    })
        .state('home', {
        url: '/home',
        template: '<home></home>'
    })
        .state('courses', {
        url: '/courses',
        template: '<home></home>'
    })
        .state('coursesStudent', {
        url: '/courses/student',
        template: '<stud-courses></stud-courses>'
    })
        .state('coursesProfessor', {
        url: '/courses/professor',
        template: '<prof-courses></prof-courses>'
    })
        .state('coursesDetail', {
        url: '/courses/detail/:courseId',
        templateProvider: function ($stateParams) {
            return '<course-detail course-id=\'' + $stateParams.courseId + '\'></course-detail>';
        },
    })
        .state('coursesNew', {
        url: '/courses/new/:courseId',
        templateProvider: function ($stateParams) {
            return '<create-course course-id=\'' + $stateParams.courseId + '\'></create-course>';
        },
    })
        .state('coursesNewComp', {
        url: '/courses/new/competencias/:courseId',
        templateProvider: function ($stateParams) {
            return '<create-course-competencias course-id=\'' + $stateParams.courseId + '\'></create-course-competencias>';
        },
    })
        .state('coursesNewEval', {
        url: '/courses/new/evaluaciones/:courseId',
        templateProvider: function ($stateParams) {
            return '<create-course-evaluaciones course-id=\'' + $stateParams.courseId + '\'></create-course-evaluaciones>';
        },
    })
        .state('coursesNewInte', {
        url: '/courses/new/interacciones/:courseId',
        templateProvider: function ($stateParams) {
            return '<create-course-interacciones course-id=\'' + $stateParams.courseId + '\'></create-course-interacciones>';
        },
    })
        .state('coursesNewNivl', {
        url: '/courses/new/niveles/:courseId',
        templateProvider: function ($stateParams) {
            return '<create-course-niveles course-id=\'' + $stateParams.courseId + '\'></create-course-niveles>';
        },
    })
        .state('coursesNewRefs', {
        url: '/courses/new/referencias/:courseId',
        templateProvider: function ($stateParams) {
            return '<create-course-referencias course-id=\'' + $stateParams.courseId + '\'></create-course-referencias>';
        },
    })
        .state('coursesView', {
        url: '/courses/view/:courseId',
        templateProvider: function ($stateParams) {
            return '<course course-id=\'' + $stateParams.courseId + '\'></course>';
        },
    })
        .state('coursesView.filterCourseByCompetence', {
        url: '/filterCourseByCompetence/:courseId/:competenceId',
        templateProvider: function ($stateParams) {
            return '<filter-course-by-competence course-id=\'' + $stateParams.courseId + '\' competence-id=\'' + $stateParams.competenceId + '\'></filter-course-by-competence>';
        },
    })
        .state('coursesView.comp', {
        url: '/competencias/:courseId',
        templateProvider: function ($stateParams) {
            return '<competencias course-id=\'' + $stateParams.courseId + '\'></competencias>';
        },
    })
        .state('coursesView.eval', {
        url: '/evaluaciones/:courseId',
        templateProvider: function ($stateParams) {
            return '<evaluaciones course-id=\'' + $stateParams.courseId + '\'></evaluaciones>';
        },
    })
        .state('coursesView.inte', {
        url: '/interacciones/:courseId',
        templateProvider: function ($stateParams) {
            return '<interacciones course-id=\'' + $stateParams.courseId + '\'></interacciones>';
        },
    })
        .state('coursesView.nivl', {
        url: '/niveles/:courseId',
        templateProvider: function ($stateParams) {
            return '<niveles course-id=\'' + $stateParams.courseId + '\'></niveles>';
        },
    })
        .state('coursesView.refs', {
        url: '/referencias/:courseId',
        templateProvider: function ($stateParams) {
            return '<referencias course-id=\'' + $stateParams.courseId + '\'></referencias>';
        },
    });
});
//# sourceMappingURL=all.js.map