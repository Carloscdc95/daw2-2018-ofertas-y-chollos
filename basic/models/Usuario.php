<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%usuarios}}".
 *
 * @property string $id
 * @property string $email Correo Electronico y "login" del usuario.
 * @property string $password
 * @property string $nick
 * @property string $nombre
 * @property string $apellidos
 * @property string $fecha_nacimiento Fecha de nacimiento del usuario o NULL si no lo quiere informar.
 * @property string $direccion Direccion del usuario o NULL si no quiere informar.
 * @property string $zona_id Area/Zona de localización del usuario o CERO si no lo quiere informar (como si fuera NULL), aunque es recomendable.
 * @property string $fecha_registro Fecha y Hora de registro del usuario o NULL si no se conoce por algún motivo (que no debería ser).
 * @property int $confirmado Indicador de usuario ha confirmado su registro o no.
 * @property string $fecha_acceso Fecha y Hora del ultimo acceso del usuario. Debería estar a NULL si no ha accedido nunca.
 * @property int $num_accesos Contador de accesos fallidos del usuario o CERO si no ha tenido o se ha reiniciado por un acceso valido o por un administrador.
 * @property int $bloqueado Indicador de usuario bloqueado: 0=No, 1=Si(bloqueada por accesos), 2=Si(bloqueada por administrador), ...
 * @property string $fecha_bloqueo Fecha y Hora del bloqueo del usuario. Debería estar a NULL si no está bloqueado o si se desbloquea.
 * @property string $notas_bloqueo Notas visibles sobre el motivo del bloqueo del usuario o NULL si no hay -se muestra por defecto según indique "bloqueado"-.
 */
class Usuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%usuarios}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'password', 'nick', 'nombre', 'apellidos', 'confirmado'], 'required'],
            [['fecha_nacimiento', 'fecha_registro', 'fecha_acceso', 'fecha_bloqueo'], 'safe'],
            [['direccion', 'notas_bloqueo'], 'string'],
            [['zona_id', 'num_accesos'], 'integer'],
            [['email'], 'string', 'max' => 255],
            [['password'], 'string', 'max' => 60],
            [['nick'], 'string', 'max' => 25],
            [['nombre'], 'string', 'max' => 50],
            [['apellidos'], 'string', 'max' => 100],
            [['confirmado', 'bloqueado'], 'string', 'max' => 1],
            [['email'], 'unique'],
            [['nick'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Contraseña'),
            'nick' => Yii::t('app', 'Nick'),
            'nombre' => Yii::t('app', 'Nombre'),
            'apellidos' => Yii::t('app', 'Apellidos'),
            'fecha_nacimiento' => Yii::t('app', 'Fecha Nacimiento (Año-mes-día)'),
            'direccion' => Yii::t('app', 'Direccion'),
            'zona_id' => Yii::t('app', 'Zona ID'),
            'fecha_registro' => Yii::t('app', 'Fecha Registro'),
            'confirmado' => Yii::t('app', 'Confirmado'),
            'fecha_acceso' => Yii::t('app', 'Fecha Acceso'),
            'num_accesos' => Yii::t('app', 'Num Accesos'),
            'bloqueado' => Yii::t('app', 'Bloqueado'),
            'fecha_bloqueo' => Yii::t('app', 'Fecha Bloqueo'),
            'notas_bloqueo' => Yii::t('app', 'Notas Bloqueo'),
        ];
    }

    /**
     * @inheritdoc
     * @return UsuariosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsuariosQuery(get_called_class());
    }
}
