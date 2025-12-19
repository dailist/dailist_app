pipeline {
  agent any

  environment {
    // GANTI dengan repo Docker Hub kamu
    IMAGE_NAME = "yustika/dailist-app"
    REGISTRY_CREDENTIALS = "dockerhub-credentials"
  }

  stages {
    stage('Checkout') {
      steps { checkout scm }
    }

    stage('Install Dependencies') {
      steps {
        // Jika composer/php belum tersedia di mesin Jenkins Windows, stage ini boleh di-skip
        bat 'composer --version'
        bat 'composer install --no-interaction'
      }
    }

    stage('Build Docker Image') {
      steps {
        bat 'docker version'
        bat 'docker build -t %IMAGE_NAME%:%BUILD_NUMBER% .'
      }
    }

    stage('Push Docker Image') {
      steps {
        withCredentials([usernamePassword(
          credentialsId: env.REGISTRY_CREDENTIALS,
          usernameVariable: 'USER',
          passwordVariable: 'PASS'
        )]) {
          bat 'docker login -u %USER% -p %PASS%'
          bat 'docker push %IMAGE_NAME%:%BUILD_NUMBER%'
          bat 'docker tag %IMAGE_NAME%:%BUILD_NUMBER% %IMAGE_NAME%:latest'
          bat 'docker push %IMAGE_NAME%:latest'
          bat 'docker logout'
        }
      }
    }
  }

  post {
    success { echo "✅ Build & Push berhasil: ${env.IMAGE_NAME}:${env.BUILD_NUMBER}" }
    failure { echo "❌ Build gagal" }
  }
}
