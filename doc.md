# BOUGE TON BOULE !

## Objet de l'appli
Proposer un service de coaching personnel pour la muscu à la maison, avec des programmes personnalisés et un suivi des performances.

## Fonctionnalités
    * Coaching sportif
    * Programmes personnalisés
    * Plusieurs niveaux de difficulté par programme
    * Variété d’exercices à réaliser sans ou avec peu de matériel
    * Personnalisation des séances de sport
    * Suivi de progression
    * Mode libre (non connecté)
    * Système de récompense
    * Timer pour les pauses entre les séries
    * Chronomètre pour des exos comme la planche

## Stack
Symfony, MySQL, React, Material UI, Cypress ?

## Contraintes
    * Utilisation de Symfony et React, ce qui impose une migration de Hostinger vers o2switch
    * Faibles connaissances en React
    * Si création d’une mascotte, beaucoup de dessins à faire
    * Création d’un fichier audio pour le timer
    * UI complexe mais robuste. La navigation doit rester intuitive, rapide et facile
    * Créer un nom de domaine + un sous-domaine pour la préprod
    * Le début d’une séance de sport doit être accessible en un clic (bouton bar nav)
    * Créer un certain nombre d’exercices et de variantes, répartis dans plusieurs niveaux
    * Définir un plan personnalisé selon les objectifs utilisateur
    * Possibilité d'effectuer des séances sans compte
    * Permettre une montée rapide en progression dans les premiers niveaux
    * Penser à une fin de parcours. Si l'utilisateur a terminé tous les niveaux il doit pouvoir continuer à utiliser l'appli (niveaux de maintien)
    * Les exercices de relaxation et bien-être sortent du schéma classique de séries et répétitions
    * Optimiser la logique métier pour ne pas surcharger la bdd
    * Si l'utilisateur ne peut  pas à effectuer une série à un exercice, propooser une variante
    * A la création d'une séance personnalisée, l'utilisateur doit pouvoir définir un ordre pour les exercices
    * L'utilisateur doit aussi pouvoir définir une durée pour le Timer

    
## Modèle de données
    * User : id, email, password, pseudo, createdAt
    * GoalCategory : id, title
    * TrainingProgram : id, title, goal_category_id, instruction
    * PersonalTrainingProgram : id, title, user_id, instruction, isFinish
    * Exercise : id, title, instruction, material (nullable), difficulty, bodyPart, priorityOrder, image
    * ExerciseInstance : training_program_id, exercise_id, level, serie, repetition_count (nullable), duration (nullable), breakTime
    * TrainingWeek : id, user_id, selectedTrainingDays(json), training_program_id (nullable), personal_training_program_id (nullable), isFinish
    * TrainingSession : id, user_id, created_at, isFinish
    * UserPerformance : id, user_id, training_session_id, exercise_instance_id, repetition_count (nullable), duration (nullable)
    * Material : id, title, weight (nullable)

## Scénario d'un programme
L'utilisateur choisit un programme parmis plusieurs catégories. On fonction du programme on lui conseille un plan d'entrainement, et il choisit quels jours de la semaine il veut s'entrainer. On lui demande ensuite s'il possède les équipements requis par le programme, en fonction de sa réponse un programme alternatif est sélectionné. 

## Scénario d'une séance
L'utilisateur débute au niveau 1. Il effectue une nouvelle TrainingSession en rentrant manuellement ses UserPerformance. A la fin de la séance on vérifie si ses UserPerformance sont celles attendus par le niveau, selon ses résultats soit il reste au niveau 1, soit il monte au niveau supérieur. On lui envoie un compte rendu de ses perfs et sa progression.

## Menu
    * Lancer une séance (bouton principal)
    * Choisir un programme
    * Créer un programme personnalisé
    * Progression
    * Mon compte 

## Catégories d'objectifs
    * Remise en forme (perte de poids)
    * Renforcement musculaire (musculation)
    * Mobilité et souplesse
    * (Relaxation et bien-être) (plus tard ?)

## Débuter un programme
Si un programme est en cours

    Continuer le programme ? 
        Oui
            Continue le programme
        Non
            Recommencer à 0 ? (efface la progression)

Sinon

    Création de la nouvelle séance et attribution du programme à l'User

## Lancer une séance
Si User

    Si dernière séance existe
        Redirection vers la séance au niveau en cours
        Énonciation des objectifs à atteindre
    Sinon (première séance)
        Séquence explicative
            Go séance
Sinon

    Choisir un programme, un niveau + bouton login + bouton info
        GO -> séance -> Bouton choisir niveau

## Exécution séance
Si User

    Exercice s'affiche, bouton Timer, si besoin bouton chronomètre
        Série N°1
            User effectue ses répétitions
            User lance Timer pour la pause
            Ouverture modal "Notez le nombre de rep..."
            User note le nombre de répétitions
        Boutons suivant et abandonner
            Si annuler
                On set les champs non remplis à 0
                modal d'encouragement, boutons poursuivre et annuler
            Si Suivant
                Séries 2,3 etc.
        Fin de la séance

Sinon

    IDEM sauf que l'User ne rentre pas ses perfs

## Terminer une séance 
Si User

    Si niveau achevé
        Modal Congrats bla bla
        Set l'User au niveau supérieur
        Affichage des niveaux terminés, compte rendu de la séance
    Sinon
        Modal séance finie
        Affichage des perf et des objectifs atteints et non atteints

Sinon

    Modal séance terminée
    Affichage des perfs

## Terminer un niveau
Stats

## Terminer un programme
Félicitations...
Stats complètes
Proposer programme personnalisé ou séance personnalisée de maintien 

## Créer un programme personnalisé
On lance le test

Si User échoue sur un exercice

    on proposera une variante plus facile

Sinon

    on calcule en fonction de son nombre de répétition ou durée

On calcule un coeff pour chaque exercice et on crée les niveaux en fonction


