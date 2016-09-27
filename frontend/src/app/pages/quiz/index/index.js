import loader from './../../../utils/loader';
import layout from '../../../layouts/quiz/quiz';
import _ from 'lodash';

export default {

  data() {
    return {
      selectedAnswer: null,
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

    // Adds value as a class to button when clicked so it turns green or red
    selectAnswer: function(answer) {
      if (this.selectedAnswer) {
        return;
      }
       this.selectedAnswer = answer;
    },
  },

  computed: {

    // Shows answers in a random order
    randomQuestion: function () {
      const randomQuestionIndex = Math.floor(Math.random() * this.questions.length);
      const question = this.questions[randomQuestionIndex];
      const answers = _.shuffle(question.answers);

      question.answers = answers;

      return question;
    },

  },

};
