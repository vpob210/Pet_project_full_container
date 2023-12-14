pipeline {
  agent any
  options {
    buildDiscarder(logRotator(numToKeepStr: '5'))
  }
    environment {
      DOCKERHUB_CREDENTIALS = credentials('DOCKERHUB')
    }
      stages {
        stage('Build') {
          steps {
            sh 'docker build -t vpob210/pet_web_full .'
          }
        }
        stage('Login') {
          steps {
            sh 'echo $DOCKERHUB_CREDENTIALS_PSW | docker login -u $DOCKERHUB_CREDENTIALS_USR --password-stdin'
          }
        }
        stage('Push') {
          steps {
            sh 'docker push vpob210/pet_web_full'
          }
        }
      }
  post {
    always {
      sh 'docker logout'
    }
  }
}
