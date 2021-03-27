<?php
session_start();

$user_id = get_current_user_id();
$user_info = get_userdata($user_id);
$user_name = $user_info->first_name . ' ' . $user_info->last_name;
$user_email = $user_info->user_email;

$test_status_option_name = 'test_status' . $user_id;
$user_test_completion_status = get_option($test_status_option_name);
//@TODO REMOVE THIS LINE
//update_option($test_status_option_name, '');

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chambers Colombo</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css">
    <link rel="stylesheet" href="<?= get_template_directory_uri() ?>/style.css">
</head>
<body>
<div class="container is-fluid body-content-wrapper">
    <div class="container form-wrapper">
        <form action="form-handler.php" id="interview-form">
            <progress class="progress is-primary" value="0" max="100" id="progress-bar"></progress>
            <progress class="progress is-primary is-hidden" max="100" id="progress-bar-loading"></progress>
            <div class="card">
                <?php
                if ($user_test_completion_status !== 'completed') {
                    ?>
                    <section class="form-section" id="question-0">
                        <div class="card-content">
                            <p class="title">
                                Interview
                            </p>
                            <p class="subtitle">
                                You have 20 minutes to complete the test. It will be automatically submitted after 20
                                minutes has elapsed.
                            </p>
                            <p class="has-text-weight-medium">Your Information:</p>
                            <p class="user-info-content"><span
                                        class="has-text-weight-medium">Name:</span> <?= $user_name ?>
                            </p>
                            <p class="user-info-content"><span
                                        class="has-text-weight-medium">Email:</span> <?= $user_email ?></p>
                        </div>
                        <footer class="card-footer">
                            <div class="button is-primary" id="start-test" data-current-question="0">Start Test</div>
                        </footer>
                    </section>
                    <section class="form-section is-hidden" id="question-1">
                        <div class="card-content">
                            <h4 class="has-text-weight-medium">
                                What is the name of the Convention that each country guarantees citizens of the other
                                countries (including USA) the same rights in Patent and TradeMarks(Industrial Property)
                                it
                                gives to its own citizens.?
                            </h4>
                            <textarea type="text" class="input mt-5" name="q-1" id="q-1"
                                      placeholder="Your Answer"></textarea>
                        </div>
                        <footer class="card-footer">
                            <div class="button is-primary next-question-button" data-current-question="1">
                                Next Question
                            </div>
                        </footer>
                    </section>
                    <section class="form-section is-hidden" id="question-2">
                        <div class="card-content">
                            <h4 class="has-text-weight-medium">
                                What is the legislation in Sri Lanka that recognizes that a Contract cannot be refused
                                for
                                simply being electronic and a handwritten signature isn't always needed for a contract
                                to be
                                considered credible?
                            </h4>
                            <textarea type="text" class="input mt-5" name="q-2" id="q-2"
                                      placeholder="Your Answer"></textarea>
                        </div>
                        <footer class="card-footer">
                            <div class="button is-primary previous-question-button" data-current-question="2">
                                Previous Question
                            </div>
                            <div class="button is-primary next-question-button" data-current-question="2">Next
                                Question
                            </div>
                        </footer>
                    </section>
                    <section class="form-section is-hidden" id="question-3">
                        <div class="card-content">
                            <h4 class="has-text-weight-medium">
                                Name 3 remedies for breach of a condition of a contract
                            </h4>
                            <input type="text" class="input mt-5" name="q-3-a" id="q-3-a" placeholder="Your Answer">
                            <input type="text" class="input mt-2" name="q-3-b" id="q-3-b" placeholder="Your Answer">
                            <input type="text" class="input mt-2" name="q-3-c" id="q-3-c" placeholder="Your Answer">
                        </div>
                        <footer class="card-footer">
                            <div class="button is-primary previous-question-button" data-current-question="3">
                                Previous Question
                            </div>
                            <div class="button is-primary next-question-button" data-current-question="3">Next Question
                            </div>
                        </footer>
                    </section>
                    <section class="form-section is-hidden" id="question-4">
                        <div class="card-content">
                            <h4 class="has-text-weight-medium">
                                A company to issue fully paid up equity shares must pass a,
                            </h4>
                            <div class="control is-flex is-flex-direction-column mt-5">
                                <label class="radio m-0">
                                    <input type="radio" name="q-4" value="Special resolution">
                                    Special resolution
                                </label>
                                <label class="radio m-0">
                                    <input type="radio" name="q-4" value="Ordinary resolution">
                                    Ordinary resolution
                                </label>
                                <label class="radio m-0">
                                    <input type="radio" name="q-4" value="Unanimous resolution">
                                    Unanimous resolution
                                </label>
                                <label class="radio m-0">
                                    <input type="radio" name="q-4" value="None of these">
                                    None of these
                                </label>
                            </div>
                        </div>
                        <footer class="card-footer">
                            <div class="button is-primary previous-question-button" data-current-question="4">
                                Previous Question
                            </div>
                            <button class="button is-primary" id="submit-test" type="submit" data-current-question="4">
                                Finish
                            </button>
                        </footer>
                    </section>
                    <section class="form-section is-hidden" id="test-completed">
                        <div class="card-content">
                            <p class="title">
                                Your Answers have been submitted!
                            </p>
                            <p class="subtitle">
                                We have received your answers and will get back to you soon. Thank you.
                            </p>
                            <p class="has-text-weight-medium">Your Information:</p>
                            <p class="user-info-content"><span
                                        class="has-text-weight-medium">Name:</span> <?= $user_name ?>
                            </p>
                            <p class="user-info-content"><span
                                        class="has-text-weight-medium">Email:</span> <?= $user_email ?></p>
                        </div>
                    </section>
                    <?php
                } else {
                    ?>
                    <section class="form-section" id="test-completed">
                        <div class="card-content">
                            <p class="title">
                                You have already completed this test.
                            </p>
                            <p class="subtitle">
                                We have received your answers and will get back to you soon. Thank you.
                            </p>
                            <p class="has-text-weight-medium">Your Information:</p>
                            <p class="user-info-content"><span
                                        class="has-text-weight-medium">Name:</span> <?= $user_name ?>
                            </p>
                            <p class="user-info-content"><span
                                        class="has-text-weight-medium">Email:</span> <?= $user_email ?></p>
                        </div>
                    </section>
                    <?php
                }
                ?>
            </div>
        </form>
    </div>
    <div class="tags has-addons is-hidden" id="timer">
        <span class="tag is-large">Time Remaining</span>
        <span class="tag is-primary is-large" id="time-tag"></span>
    </div>
</div>
<?php
if ($user_test_completion_status !== 'completed') {
    ?>
    <script>
      let timeout

      document.addEventListener('DOMContentLoaded', () => {

        //  Starting the test
        const startButton = document.getElementById('start-test')
        const interviewForm = document.getElementById('interview-form')
        const timerDisplay = document.getElementById('timer')
        const nextButtons = document.querySelectorAll('.next-question-button')
        const previousButtons = document.querySelectorAll('.previous-question-button')

        startButton.addEventListener('click', () => {
          callTimer('startTest')
          timerDisplay.classList.remove('is-hidden')
          startCountdown()
          moveToNextQuestion(0)
        })

        nextButtons.forEach(element => {
          element.addEventListener('click', () => {
            moveToNextQuestion(parseInt(element.dataset.currentQuestion))
          })
        })

        previousButtons.forEach(element => {
          element.addEventListener('click', () => {
            moveToPreviousQuestion(parseInt(element.dataset.currentQuestion))
          })
        })

        interviewForm.addEventListener('submit', event => {
          event.preventDefault()
          submitForm(interviewForm)
        })

      })

      function submitForm () {
        let questionFour = ''
        const formSections = document.querySelectorAll('.form-section')
        const formSubmittedScreen = document.getElementById('test-completed')
        const progressBar = document.getElementById('progress-bar')
        const progressBarLoading = document.getElementById('progress-bar-loading')
        const timerDisplay = document.getElementById('timer')

        progressBar.classList.add('is-hidden')
        progressBarLoading.classList.remove('is-hidden')
        timerDisplay.classList.add('is-hidden')
        clearInterval(timeout)

        document.getElementsByName('q-4').forEach(element => {
          if (element.checked) {
            questionFour = element.value
          }
        })
        const answers = [
          {
            questionOne: document.getElementById('q-1').value,
            questionTwo: document.getElementById('q-2').value,
            questionThreeA: document.getElementById('q-3-a').value,
            questionThreeB: document.getElementById('q-3-b').value,
            questionThreeC: document.getElementById('q-3-c').value,
            questionFour: questionFour,
          }]

        fetch('<?=get_template_directory_uri()?>/form-handler.php', {
          method: 'POST',
          headers: {
            'Accept': 'application/json, text/plain, */*',
            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
          },
          body: 'answers=' + JSON.stringify(answers),
        }).then(response => {
          if (response.status >= 200 && response.status < 300) {
            return response.text()
          }
          throw new Error(response.statusText)
        }).then(response => {
          console.log(response)
          fetch('https://api.apispreadsheets.com/data/10111/', {
            method: 'POST',
            body: JSON.stringify({
              'data': JSON.parse(response),
            }),
          }).then(res => {
            if (res.status === 201) {
              formSections.forEach(element => {
                element.classList.add('is-hidden')
              })
              formSubmittedScreen.classList.remove('is-hidden')
              progressBar.classList.remove('is-hidden')
              progressBarLoading.classList.add('is-hidden')
            } else {
              throw new Error(`Couldn't save to google sheets`)
            }
          })
        })
      }

      function startCountdown () {
        timeout = setInterval(() => callTimer('getRemainingTime'), 1000)
      }

      function updateTimerDisplay (time) {
        const timeTag = document.getElementById('time-tag')
        timeTag.innerText = time
      }

      function moveToNextQuestion (currentQuestion) {
        const currentSection = document.getElementById(`question-${currentQuestion}`)
        const nextSection = document.getElementById(`question-${currentQuestion + 1}`)
        const progressBar = document.getElementById('progress-bar')

        currentSection.classList.add('is-hidden')
        nextSection.classList.remove('is-hidden')
        progressBar.value = (currentQuestion + 1) * 25
      }

      function moveToPreviousQuestion (currentQuestion) {
        const currentSection = document.getElementById(`question-${currentQuestion}`)
        const nextSection = document.getElementById(`question-${currentQuestion - 1}`)
        const progressBar = document.getElementById('progress-bar')

        currentSection.classList.add('is-hidden')
        nextSection.classList.remove('is-hidden')
        progressBar.value = (currentQuestion - 1) * 25
      }

      function callTimer (status) {
        const timeTag = document.getElementById('time-tag')

        fetch('<?=get_template_directory_uri()?>/timer.php', {
          method: 'POST',
          headers: {
            'Accept': 'application/json, text/plain, */*',
            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
          },
          body: 'status=' + status,
        }).then(response => {
          if (response.status >= 200 && response.status < 300) {
            return response.text()
          }
          throw new Error(response.statusText)
        }).then(response => {
          if (response === 'Time Expired') {
            clearInterval(timeout)
          }
          if (response === '10:00') {
            timeTag.classList.add('is-warning')
          }
          if (response === '05:00') {
            timeTag.classList.add('is-danger')
          }
          updateTimerDisplay(response)
        })
      }
    </script>
    <?php
}
?>
</body>
</html>