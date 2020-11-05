<template>
  <div class="row">
      <div class="col-md-12">
          <h1>Generate Score</h1>
          <h4>{{error}}</h4>
          <h4 v-if="success_response.score">Score: {{success_response.score}} added successfully</h4>
          <form @submit.prevent="generateScore()">
            <div class="d-flex">
                <div class="form-group m-1">
                    <label>Minimum Score</label>
                    <input type="number" class="form-control" v-model="form.min_number" @input="setMaxNumber" required>
                    <label class="text-danger" v-if="error_response.min_number">{{error_response.min_number[0]}}</label>
                </div>
                <div class="form-group m-1">
                    <label>Maximum Score</label>
                    <input type="number" class="form-control" v-model="form.max_number" :min="parseInt(form.min_number) + 1" required>
                    <label class="text-danger" v-if="error_response.max_number">{{error_response.max_number[0]}}</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary m-1">Generate</button>
          </form>
      </div>
      <div class="col-md-6 mt-2">
          <h3>Scores List</h3>
          <table class="table">
            <thead>
                <tr>
                    <th scope="col">Score</th>
                    <th scope="col">Count</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="score in scores" :key="score.id">
                    <th scope="row" @click="getScoreData(score)" style="cursor: pointer;"><span class="text-primary" style="cursor: pointer;"><u>{{score.score}}</u></span></th>
                    <td>{{score.count}}</td>
                </tr>
            </tbody>
          </table>
      </div>
      <div class="col-md-6 mt-2">
          <h3>Score Data <span v-if="score.length > 0">- Generated {{score.length}} times</span></h3>
          <table class="table">
            <thead>
                <tr>
                    <th scope="col">Score</th>
                    <th scope="col">Created at</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="data in score" :key="data.id">
                    <th scope="row">{{data.score}}</th>
                    <td>{{moment(data.created_at).format('MMMM Do YYYY, h:mm a')}}</td>
                </tr>
            </tbody>
          </table>
      </div>
  </div>
</template>
<script src="./src/index.js"></script>