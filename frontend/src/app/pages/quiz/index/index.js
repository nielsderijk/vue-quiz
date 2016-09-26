import loader from './../../../utils/loader';
import layout from '../../../layouts/quiz/quiz';
import _ from 'lodash';

export default {

  data() {
    return {
      title: 'A Nintendo Quiz made in Vue',
      questions: [
        {
          id: 1,
          image: 'http://www.smartworld.it/wp-content/uploads/2016/06/The-Legend-of-Zelda-Breath-of-Wild-Title-1280x720.png',
          question: 'Which of these things Link can NOT do in the upcoming Zelda game, Breath of the Wild?',
          answers: [
            {text: 'Swap gender', mark: true},
            {text: 'Climb mountains', mark: false},
            {text: 'Stop time', mark: false},
            {text: 'Cut trees', mark: false}
          ],
        },
        {
          id: 2,
          image: 'http://cdn.thegadgetflow.com/wp-content/uploads/2016/07/Nintendo-NES-Classic-Edition-02.jpg',
          question: 'Which game can NOT be played on the NES Classic Edition system (due to be released in November 2016)?',
          answers: [
            {text: 'Tetris', mark: true},
            {text: 'Castlevania II: Simon\'s Quest', mark: false},
            {text: 'StarTropics', mark: false},
            {text: 'MEGA MAN 2', mark: false}
          ],
        },
        {
          id: 3,
          image: 'https://i.ytimg.com/vi/mxhdsL-VHbM/maxresdefault.jpg',
          question: 'In the movie The King of Kong: A Fistful of Quarters (2007), Steve Wiebe challenges whom to become a champion in Donkey Kong?',
          answers: [
            {text: 'Billy Mitchell', mark: true},
            {text: 'Hank Chien', mark: false},
            {text: 'Dean Saglio', mark: false},
            {text: 'Wes Copeland', mark: false}
          ],
        },
        {
          id: 4,
          image: 'http://www.mobygames.com/images/shots/l/218714-super-mario-world-snes-screenshot-flying-with-a-cape.png',
          question: 'What power-up in Super Mario World (1991) gives Mario his cape?',
          answers: [
            {text: 'A Feather', mark: true},
            {text: 'A Super Leaf', mark: false},
            {text: 'A Flower', mark: false},
            {text: 'A P-acorn', mark: false}
          ],
        },
      ],
    }
  },

  methods: {

  },

  computed: {
    randomQuestion: function () {
      const randomQuestionIndex = Math.floor(Math.random() * this.questions.length);
      const question = this.questions[randomQuestionIndex];
      const answers = _.shuffle(question.answers);

      question.answers = answers;

      return question;
    }
  },

  // methods: {
  //   checkAnswer: function(option) {
  //     // Check if the question has already been answered
  //     if (!option.$parent.answered) {
  //       // Find out which option is the correct answer to this question
  //       var correct = option.$parent.correctOptionByIndex;
  //       // Set the property of the correct option's mark attribute to true
  //       option.$parent.options[correct].mark = true;
  //       // Check if what we clicked the wrong answer
  //       if (!option.mark) {
  //         // Grab the element that was clicked
  //         var el = option.$el;
  //         // Add the incorrect class
  //         $(el).addClass("incorrect");
  //         // Show the incorrect response
  //         option.$parent.incorrectResponse.hide = false;
  //       } else {
  //         // The answer they selected was correct, so add to the user's quiz score
  //         this.score += 1;
  //         // Show the correct response
  //         option.$parent.correctResponse.hide = false;
  //       }
  //       // Mark that the question has now been answered, so clicks won't do anything anymore
  //       option.$parent.answered = true;
  //       this.questionsAnswered += 1;
  //     }
  //
  //     // Check if its the last question that was just answered
  //     if (this.questionsAnswered == this.countQuestions()) {
  //       // Get the score as a percentage
  //       var score = this.score / this.countQuestions();
  //       if (score <= 0.25) {
  //         this.results[0].hide = false;
  //       } else if (score <= 0.5) {
  //         this.results[1].hide = false;
  //       } else if (score <= 0.75) {
  //         this.results[2].hide = false;
  //       } else if (score <= 1) {
  //         this.results[3].hide = false;
  //       }
  //     }
  //   },
  //   getScore: function() {
  //     return this.score;
  //   },
  //   countQuestions: function() {
  //     return this.questions.length;
  //   }
  // }


};
