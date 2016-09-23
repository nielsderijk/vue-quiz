import loader from './../../../utils/loader';

export default {
  components: {
    VLayout: loader.layout('quiz'),
  },
};


//
// var vm = new Vue({
// 	el: '#questions',
// 	data: {
// 		title: 'A Nintendo Quiz made in Vue',
// 		tagline: 'Take the quiz to see how much you know about Nintendo',
// 		score: 0,
// 		questionsAnswered: 0,
// 		questions: [
// 			{
// 				id: 1,
//         image: 'http://www.smartworld.it/wp-content/uploads/2016/06/The-Legend-of-Zelda-Breath-of-Wild-Title-1280x720.png',
// 				question: 'Which of these things Link can NOT do in the upcoming Zelda game, Breath of the Wild?',
// 				options: [
// 					{text: 'Swap gender', mark: true},
// 					{text: 'Climb mountains', mark: false},
// 					{text: 'Stop time', mark: false},
// 					{text: 'Cut trees', mark: false}
// 				],
// 			},
//       {
// 				id: 2,
//         image: 'http://cdn.thegadgetflow.com/wp-content/uploads/2016/07/Nintendo-NES-Classic-Edition-02.jpg',
// 				question: 'Which game can NOT be played on the NES Classic Edition system (due to be released in November 2016)?',
// 				options: [
// 					{text: 'Tetris', mark: true},
// 					{text: 'Castlevania II: Simon\'s Quest', mark: false},
// 					{text: 'StarTropics', mark: false},
// 					{text: 'MEGA MAN 2', mark: false}
// 				],
// 			},
//       {
//         id: 3,
//         image: 'https://i.ytimg.com/vi/mxhdsL-VHbM/maxresdefault.jpg',
// 				question: 'In the movie The King of Kong: A Fistful of Quarters (2007), Steve Wiebe challenges whom to become a champion in Donkey Kong?',
// 				options: [
// 					{text: 'Billy Mitchell', mark: true},
// 					{text: 'Hank Chien', mark: false},
// 					{text: 'Dean Saglio', mark: false},
// 					{text: 'Wes Copeland', mark: false}
// 				],
// 			},
//       {
//         id: 4,
//         image: 'http://www.mobygames.com/images/shots/l/218714-super-mario-world-snes-screenshot-flying-with-a-cape.png',
// 				question: 'What power-up in Super Mario World (1991) gives Mario his cape?',
// 				options: [
// 					{text: 'A Feather', mark: true},
// 					{text: 'A Super Leaf', mark: false},
// 					{text: 'A Flower', mark: false},
// 					{text: 'A P-acorn', mark: false}
// 				],
// 			},
// 		],
// 		results: [
// 			{
// 				id: 1,
// 				text: "That was a tough quiz, but feel free to take it again. The most important thing to remember is that smokefree establishments are better - no longer should you have to sacrifice the flavor of your food or drinks.",
// 				twitter: "http://www.twitter.com",
// 				facebook: "http://www.facebook.com",
// 				hide: true
// 			},
// 			{
// 				id: 2,
// 				text: "It's hard to know EVERYTHING, especially when it comes to the nightlife. But if there was anything to learn from this experience, it's that you should always choose smokefree establishments - it just makes your experience that much better.",
// 				twitter: "http://www.twitter.com",
// 				facebook: "http://www.facebook.com",
// 				hide: true
// 			},
// 			{
// 				id: 3,
// 				text: "You may not have gotten a perfect score, but it's never too late to deepen your knowledge on Oklahoma nightlife. And the best way to do so is to go out more, but when you decide to go out, choose smokefree establishments - a tobacco-free environment just makes the night that much better.",
// 				twitter: "http://www.twitter.com",
// 				facebook: "http://www.facebook.com",
// 				hide: true
// 			},
// 			{
// 				id: 4,
// 				text: "Your knowledge proves that you have mastered the OK NIGHTLIFE experience. And the best way to prolong that lifestyle is to visit non-smoking bars and clubs, because whether you're eating, drinking, or dancing - a tobacco-free environment is just that much better.",
// 				twitter: "http://www.twitter.com",
// 				facebook: "http://www.facebook.com",
// 				hide: true
// 			},
// 		]
// 	},
// 	methods: {
// 		checkAnswer: function(option) {
// 			// Check if the question has already been answered
// 			if (!option.$parent.answered) {
// 				// Find out which option is the correct answer to this question
// 				var correct = option.$parent.correctOptionByIndex;
// 				// Set the property of the correct option's mark attribute to true
// 				option.$parent.options[correct].mark = true;
// 				// Check if what we clicked the wrong answer
// 				if (!option.mark) {
// 					// Grab the element that was clicked
// 					var el = option.$el;
// 					// Add the incorrect class
// 					$(el).addClass("incorrect");
// 					// Show the incorrect response
// 					option.$parent.incorrectResponse.hide = false;
// 				} else {
// 					// The answer they selected was correct, so add to the user's quiz score
// 					this.score += 1;
// 					// Show the correct response
// 					option.$parent.correctResponse.hide = false;
// 				}
// 				// Mark that the question has now been answered, so clicks won't do anything anymore
// 				option.$parent.answered = true;
// 				this.questionsAnswered += 1;
// 			}
//
// 			// Check if its the last question that was just answered
// 			if (this.questionsAnswered == this.countQuestions()) {
// 				// Get the score as a percentage
// 				var score = this.score / this.countQuestions();
// 				if (score <= 0.25) {
// 					this.results[0].hide = false;
// 				} else if (score <= 0.5) {
// 					this.results[1].hide = false;
// 				} else if (score <= 0.75) {
// 					this.results[2].hide = false;
// 				} else if (score <= 1) {
// 					this.results[3].hide = false;
// 				}
// 			}
// 		},
// 		getScore: function() {
// 			return this.score;
// 		},
// 		countQuestions: function() {
// 			return this.questions.length;
// 		}
// 	}
// })
