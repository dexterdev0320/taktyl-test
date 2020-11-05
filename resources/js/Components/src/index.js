var moment = require('moment')
export default {
    data() {
        return {
            moment: moment,
            score: [],
            scores: [],
            form: {},
            success_response: '',
            error_response: {},
            error: '',
        }
    },
    mounted() {
        this.getScores()
    },
    methods: {
        getScores() {
            this.$http.get(`api/scores`)
            .then(response => this.scores = response.data.scores)
            .catch(error => console.log(error))
        },
        getScoreData(score) {
            this.$http.get(`api/scores/${score.score}`)
            .then(response => this.score = response.data.score)
            .catch(error => console.log(error))
        },
        setMaxNumber() {
            this.form.min_number = parseInt(this.form.min_number)
            return (this.form.min_number !== '') ? this.form.max_number = parseInt(this.form.min_number) + 1 : this.form = {}
        },
        generateScore() {
            if(this.form.min_number > this.form.max_number) {
                return this.error = 'Invalid! The minimum number should be greater than the maximum number.'
            }

            this.error = '';
            this.$http.post(`api/scores`, this.form)
            .then(response => this.success_response = response.data.result)
            .then(response => {
                this.getScores();
            })
            .catch(error => {
                if(error.response.status === 422) {
                    this.error_response = error.response.data.errors
                    console.log(this.error_response)
                }
            })
        }
    },
}