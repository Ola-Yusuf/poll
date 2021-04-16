// node {
//     stage("composer_install") {
//         // Run `composer update` as a shell script
//         sh 'composer update'
//     }
//     stage("phpunit") {
//         // Run PHPUnit
//         sh 'vendor/bin/phpunit'
//     }

//     // If this is the master or develop branch being built then run
//     // some additional integration tests
//     if (["master", "develop"].contains(env.BRANCH_NAME)) {
//         stage("integration_tests") {
//             sh 'vendor/bin/behat'
//         }
//     }

//     // Create new deployment assets
//     // switch (env.BRANCH_NAME) {
//     //     case "master":
//     //         stage("codedeploy") {
//     //             sh "aws deploy push --application-name My_App_Production --s3-location s3://my-app-production/build-${env.BUILD_NUMBER}.zip"
//     //         }
//     //         break
//     //     case "develop":
//     //         stage("codedeploy") {
//     //             sh "aws deploy push --application-name My_App_Staging --s3-location s3://my-app-staging/build-${env.BUILD_NUMBER}.zip"
//     //         }
//     //         break
//     //     default:
//     //         // No deployments for other branches
//     //         break
//     // }
// }

pipeline {
    agent any

    stages {
        stage('Hello') {
            steps {
                echo 'Hello World'
            }
        }
        // stage("composer_install") {
        // // Run `composer update` as a shell script
        // steps {
        //         sh 'composer update'
        //     }
        // }
        // stage("phpunit") {
        //     // Run PHPUnit
        //     steps {
        //         sh 'vendor/bin/phpunit'
        //     }
        // }

        // If this is the master or develop branch being built then run
        // some additional integration tests
            stage("integration_tests") {
              steps {
              // if (["master", "jenkins"].contains(env.BRANCH_NAME)) {

                sh 'vendor/bin/behat'
              // }
            }
            
        }
        
    }
}