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
                    // Шаг для выполнения сборки Docker образа на удаленном сервере
                //     sshagent(['ssh-pet-id']) {
                //         sh 'ssh ${REMOTE_HOST} "cd ${PROJECT_FOLDER} && docker build -t pet_web_full ."'
                //         // sh '${REMOTE_HOST} "docker rmi $(docker images | awk 'NR>1 {print $3}')"'
                //     }
                }
            }
        }
        stage('Push to DockerHub') {
            steps {
                script {
                    // Шаг для пуша собранного образа в DockerHub
                     sshagent(['ssh-pet-id', 'DOCKERHUB']) {
                        sh " echo \$DOCKERHUB_USERNAME "
                        // sh "ssh -t ${REMOTE_HOST} 'docker login -u \$DOCKERHUB_USERNAME -p \$DOCKERHUB_PASSWORD && docker push pet_web_full'"
                        sh "ssh ${REMOTE_HOST} 'docker push docker push vpob210/pet_web_full:latest'"
                     }
                }
            }
        }
    }
}
