<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\RegisterForm;
use app\models\ContactForm;
use app\models\CalcForm;
use app\models\RawTypes;
use app\models\Tonnages;
use app\models\Months;
use app\models\Prices;
use app\models\User;
use app\models\History;
use yii\db\Expression;
use yii\data\Pagination;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;


class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
{
    $adminUser = User::find()->where(['role' => 'admin'])->one();

    if (!$adminUser) {

        $adminUser = new User();
        $adminUser->username = 'Admin';
        $adminUser->password = Yii::$app->security->generatePasswordHash('123456');
        $adminUser->email = 'Admin@localhost';
        $adminUser->role = 'admin'; 
        $adminUser->save();

        $auth = Yii::$app->authManager;
        $adminRole = $auth->getRole('Admin');
        if ($adminRole) {
            $auth->assign($adminRole, $adminUser->id);
        }
        
    }

    return $this->render('index');
}

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['site/calc']);
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionCalc(){
        $model = new Prices();

        if ($model->load(Yii::$app->request->post()) && $model->validate() && Yii::$app->request->isPjax) {

            $calculation = Prices::find()
                ->where(['month_id' => $model->month_id])
                ->andWhere(['raw_type_id' => $model->raw_type_id])
                ->andWhere(['tonnage_id' => $model->tonnage_id])
                ->one();

                $calculationHistory = new History();
                $calculationHistory->user_id = Yii::$app->user->id;
                $calculationHistory->month_id = $model->month_id;
                $calculationHistory->raw_type_id = $model->raw_type_id;
                $calculationHistory->tonnage_id = $model->tonnage_id;
                $calculationHistory->price = $calculation->price;
                $calculationHistory->save();
        
            return $this->render('calc', compact('model', 'calculation'));
        }

        return $this->render('calc', compact('model'));
    }

    public function actionHistory()
{
    $userId = Yii::$app->user->id;

        $dataProvider = new ActiveDataProvider([
            'query' => History::find()->where(['user_id' => $userId])->with(['user', 'month', 'tonnage', 'rawType']),
        ]);

        $months = Months::getListForSelect();
        $tonnages = Tonnages::getListForSelect();
        $rawTypes = RawTypes::getListForSelect();

        return $this->render('history', [
            'dataProvider' => $dataProvider,
            'months' => $months,
            'tonnages' => $tonnages,
            'rawTypes' => $rawTypes,
    ]);
}

    public function actionRegister()
    {
        $model = new \app\models\RegisterForm(); 
        
            if ($model->load(Yii::$app->request->post())) {
                if ($user = $model->register()) {
                    if ($user instanceof \yii\web\IdentityInterface && Yii::$app->getUser()->login($user)) {
                        return $this->redirect(['site/login']);
                    }
                }
            }
        
        return $this->render('register', [
            'model' => $model,
        ]);
    }

    public function actionProfile()
    {
        $userId = Yii::$app->user->id;
        $userProfile = User::findOne($userId);
        
        return $this->render('profile', ['userProfile' => $userProfile]);
    }

    public function actionUsers()
    {
        $users = User::find()->all();

        return $this->render('users', [
            'users' => $users,
        ]);
    }

}

