<?php
/**
 * 上海葡萄纬度科技有限公司.
 * @copyright Copyright (c) 2017 Shanghai Putao Technology Co., Ltd.
 * @license http://www.putao.com/
 * @author Zhang Jianfeng <zhangjianfeng@putao.com>
 * @date: 2017/7/14 20:57
 * @version 3.0.0
 */

namespace App\Core\Model;


use Kerisy\Db\ActiveRecord;

/**
 *
 * @property int $college_id
 * @property string $name
 * @property int $bachelor_score
 * @property int $master_score
 * @property int $created_at
 * @property int $updated_at
 *
 * @package App\Core\Model
 */
class College extends ActiveRecord
{
    public static function primaryKey()
    {
        return ['college_id'];
    }

    public static function tableName()
    {
        return '{{college}}';
    }

    public static function getDb()
    {
        return parent::getDb();
    }
}