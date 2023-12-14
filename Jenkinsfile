pipeline {
    agent any

    environment {
        REMOTE_HOST = '192.168.66.195'
        REMOTE_USER = 'jenkins'
        PROJECT_FOLDER = 'Pet_web_full'
    }

    stages {
        stage('Check Workspace Content') {
            steps {
                script {
                    // Вывести содержимое рабочей директории перед клонированием
                    sh "ls -lah ${WORKSPACE}"
                }
            }
        }
        stage('SSH and Wall') {
            steps {
                script {
                    sshagent(['ssh-pet-id']) {
                        // Команда, которую нужно выполнить
                        def command = 'wall "Hello from Jenkins!"'

                        // Выполняем команду по SSH как вариант ${REMOTE_USER}@${REMOTE_HOST} - но это не нужно
                        sh "ssh -o StrictHostKeyChecking=no ${REMOTE_HOST} '${command}'"

                        def rsync = """
                        rsync -r -C --delete ${WORKSPACE}/. ${REMOTE_HOST}:/home/${REMOTE_USER}/${PROJECT_FOLDER}/
                        """
                        sh rsync
                    }
                }
            }
        }
    }
}
