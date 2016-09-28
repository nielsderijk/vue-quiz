// import loader from './../../../utils/loader';
// import layout from '../../../layouts/quiz/quiz';
import { TweenMax, TimelineMax } from 'gsap';
import _ from 'lodash';

export default {

  data() {
    return {
      count: 0,
      selectedAnswer: null,
      viewedQuestions: [],
      title: 'A Nintendo Quiz made in Vue',
      questions: [
        {
          id: 1,
          image: 'http://www.pcgames.de/screenshots/original/2014/12/The_Legend_Of_Zelda_WiiU_01_crop-videogameszone.jpg',
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
          image: 'http://www.mariowiki.com/images/e/ee/Butter_Bridge_2.png',
          question: 'What power-up in Super Mario World (1991) gives Mario his cape?',
          answers: [
            {text: 'A Feather', mark: true},
            {text: 'A Super Leaf', mark: false},
            {text: 'A Flower', mark: false},
            {text: 'A P-acorn', mark: false}
          ],
        },
        {
          id: 5,
          image: 'https://cdn3.twinfinite.net/wp-content/uploads/2016/07/tumblr_static_4dfdwwm484mccgggkwwg04soo.png',
          question: 'What is the name of this Pokémon?',
          answers: [
            {text: 'Dragonite', mark: true},
            {text: 'Charizard', mark: false},
            {text: 'Charmander', mark: false},
            {text: 'Flygon', mark: false}
          ],
        },
        {
          id: 6,
          image: 'https://sickr.files.wordpress.com/2014/10/mario_kart8_mercedes.jpg?w=1200',
          question: 'From which car brand are the karts and tires in the Mario Kart 8 DLC Pack released in August 2014?',
          answers: [
            {text: 'Mercedes-Benz', mark: true},
            {text: 'Toyota', mark: false},
            {text: 'Mazda', mark: false},
            {text: 'BMW', mark: false}
          ],
        },
        {
          id: 7,
          image: 'http://images.nintendolife.com/news/2013/01/ninterview_cosplayer_regina_rikkugrape_marie/attachment/3/original.jpg',
          question: 'Which Zelda character is cosplayed here?',
          answers: [
            {text: 'Saria', mark: true},
            {text: 'Princess Ruto', mark: false},
            {text: 'Anju', mark: false},
            {text: 'Nabooru', mark: false}
          ],
        },
        {
          id: 8,
          image: 'https://d13yacurqjgara.cloudfront.net/users/3374/screenshots/197696/attachments/3466/handheld_timeline.png',
          question: 'With approximately 154 million units shipped worldwide, what is Nintendo\'s best selling handheld to date?',
          answers: [
            {text: 'Nintendo DS', mark: true},
            {text: 'Game Boy', mark: false},
            {text: 'Nintendo 3DS', mark: false},
            {text: 'Game Boy Color', mark: false}
          ],
        },
      ],
    }
  },

  route: {
    activate() {
      // console.log('test');
    },
  },

  methods: {

    // Returns value if answer is correct so button can turn green or red + updates counter
    selectAnswer: function(answer) {
       this.selectedAnswer = answer;
       this.updateCount(answer);
    },

    // Updates score when correct answer is clicked
    updateCount: function(selectedAnswer) {
      if (selectedAnswer.mark === true) {
        this.count += 20;
      }
    },


    close: function () {
      this.onClose();
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
