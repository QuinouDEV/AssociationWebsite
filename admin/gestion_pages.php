<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../img/logo.png" type="image/png">
    <title>IFJR - Gestion des Pages</title>
  <!-- font awesome icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <style>
    body {
        font-family: 'Montserrat';
    }
    </style>
</head>

<body>
  <?php
  session_start();
  if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'admin') {
    header("Location: ../login.php");
    exit();
  }
  include 'panel.php';

  $questionsFile = 'main_page.json';
  $questionsData = file_get_contents($questionsFile);
  $questions = json_decode($questionsData, true);


  if (isset($_POST['add_question'])) {
    $question = $_POST['question'];
    $answer = $_POST['answer'];


    $existingQuestion = false;
    foreach ($questions['questions'] as $qa) {
      if ($qa['question'] === $question) {
        $existingQuestion = true;
        break;
      }
    }

    if ($existingQuestion) {
      echo '<script>alert("La question existe déjà.");</script>';
    } else {

      $newQuestion = array(
        'question' => $question,
        'answer' => $answer
      );
      $questions['questions'][] = $newQuestion;


      $questionsData = json_encode($questions, JSON_PRETTY_PRINT);
      file_put_contents($questionsFile, $questionsData);
    }
  }



  if (isset($_POST['edit-question-submit'])) {
    $questionIndex = $_POST['edit-question-index'];
    $newQuestion = $_POST['edit-question'];
    $newAnswer = $_POST['edit-answer'];


    if (isset($questions['questions'][$questionIndex])) {
      $questions['questions'][$questionIndex]['question'] = $newQuestion;
      $questions['questions'][$questionIndex]['answer'] = $newAnswer;


      $questionsData = json_encode($questions, JSON_PRETTY_PRINT);
      file_put_contents($questionsFile, $questionsData);
    }
  }


  if (isset($_POST['delete_question'])) {
    $questionIndex = $_POST['question_index'];


    if (isset($questions['questions'][$questionIndex])) {

      unset($questions['questions'][$questionIndex]);


      $questions['questions'] = array_values($questions['questions']);


      $questionsData = json_encode($questions, JSON_PRETTY_PRINT);
      file_put_contents($questionsFile, $questionsData);
    }
  }



  ?>

  <div class="dashboard-main">
    <div class="container">
      <div class="row py-3">
        <div class="col-12 d-flex justify-content-between align-items-center">
          <div class="dashboard-title-text">
            <h2>Questions et Réponses</h2>
            <p class="text-grey">Voici la liste des questions et réponses.</p>
          </div>
          <button type="button" class="fs-18 text-grey-blue">
            <i class="fas fa-ellipsis-vertical"></i>
          </button>
        </div>
      </div>
      <div class="overview-section p-4">
        <div class="row">
          <div class="col-12">
            <div class="text-end mb-3">
              <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ajouterQuestionModal">Ajouter une
                question</button>
            </div>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">Question</th>
                  <th scope="col">Réponse</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($questions['questions'] as $index => $qa) {
                  echo '<tr>';
                  echo '<td>' . $qa['question'] . '</td>';
                  echo '<td>' . $qa['answer'] . '</td>';
                  echo '<td>';
                  echo '<input type="hidden" name="question_index" value="' . $index . '">';
                  echo '<button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#supprimerQuestionModal" data-question-index="' . $index . '" data-question="' . $qa['question'] . '" data-answer="' . $qa['answer'] . '"><i class="fas fa-trash"></i></button>';
                  echo '<button class="btn btn-link edit-user" data-bs-toggle="modal" data-bs-target="#modifierUtilisateurModal" data-question="' . $qa['question'] . '" data-answer="' . $qa['answer'] . '" data-question-index="' . $index . '"><i class="fas fa-edit"></i></button>';
                  echo '</td>';
                  echo '</tr>';
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal d'ajout de question -->
  <div class="modal fade" id="ajouterQuestionModal" tabindex="-1" aria-labelledby="ajouterQuestionModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ajouterQuestionModalLabel">Ajouter une question</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="">
            <div class="mb-3">
              <label for="question" class="form-label">Question</label>
              <input type="text" class="form-control" id="question" name="question" required>
            </div>
            <div class="mb-3">
              <label for="answer" class="form-label">Réponse</label>
              <input type="text" class="form-control" id="answer" name="answer" required>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
              <button type="submit" class="btn btn-primary" name="add_question">Ajouter</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal de suppression question -->
  <div class="modal fade" id="supprimerQuestionModal" tabindex="-1" aria-labelledby="supprimerQuestionModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="supprimerQuestionModalLabel">Êtes-vous sûr de vouloir supprimer cette question ?
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-footer">
          <form id="deleteQuestionForm" method="POST" action="">
            <input type="hidden" id="delete-question-index" name="question_index">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
            <button type="submit" class="btn btn-danger" name="delete_question">Oui</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal de modification de question -->
  <div class="modal fade" id="modifierUtilisateurModal" tabindex="-1" aria-labelledby="modifierUtilisateurModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modifierUtilisateurModalLabel">Modifier une question</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="editQuestionForm" method="POST" action="">
            <div class="mb-3">
              <label for="edit-question" class="form-label">Question</label>
              <input type="text" class="form-control" id="edit-question" name="edit-question" required>
            </div>
            <div class="mb-3">
              <label for="edit-answer" class="form-label">Réponse</label>
              <input type="text" class="form-control" id="edit-answer" name="edit-answer" required>
            </div>
            <input type="hidden" id="edit-question-index" name="edit-question-index">
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
              <button type="submit" class="btn btn-primary" id="edit-question-submit"
                name="edit-question-submit">Enregistrer</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
  <!-- font awesome icons -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"
    referrerpolicy="no-referrer"></script>

  <script>
    var editQuestionModal = document.getElementById('modifierUtilisateurModal');
    editQuestionModal.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget;
      var question = button.getAttribute('data-question');
      var answer = button.getAttribute('data-answer');
      var questionIndex = button.getAttribute('data-question-index');


      var editQuestionForm = document.getElementById('editQuestionForm');
      var editQuestionInput = editQuestionForm.querySelector('#edit-question');
      var editAnswerInput = editQuestionForm.querySelector('#edit-answer');
      var editQuestionIndexInput = editQuestionForm.querySelector('#edit-question-index');
      editQuestionInput.value = question;
      editAnswerInput.value = answer;
      editQuestionIndexInput.value = questionIndex;
    });

    var deleteQuestionModal = document.getElementById('supprimerQuestionModal');
    deleteQuestionModal.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget;
      var questionIndex = button.getAttribute('data-question-index');
      var deleteQuestionForm = document.getElementById('deleteQuestionForm');
      var deleteQuestionIndexInput = deleteQuestionForm.querySelector('#delete-question-index');
      deleteQuestionIndexInput.value = questionIndex;
    });



  </script>

</body>

</html>