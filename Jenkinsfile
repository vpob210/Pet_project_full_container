pipeline {
    agent any

    environment {
        REMOTE_HOST = '192.168.66.195'
        REMOTE_USER = 'jenkins'
    }

    stages {
        stage('SSH and Wall') {
            steps {
                script {
                    sshagent(['ssh-pet-id']) {
                        // Команда, которую нужно выполнить
                        def command = 'wall "Hello from Jenkins!"'

                        // Выполняем команду по SSH как вариант ${REMOTE_USER}@${REMOTE_HOST} - но это не нужно
                        sh "ssh -o StrictHostKeyChecking=no ${REMOTE_HOST} '${command}'"
                    }
                }
            }
        }
    }
}
