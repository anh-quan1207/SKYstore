<?php
namespace App\Enums;

enum CategoryParentEnum: int
{

    case FASHION_MEN = 1;
    case FASHION_WOMEN = 2;
    case SPORTSWEAR = 3;

    public static function getStatusText(int $status): string
    {

        $statusTexts = [
            self::FASHION_MEN->value => "Thời Trang Nam",
            self::FASHION_WOMEN->value => "Thời Trang Nữ",
            self::SPORTSWEAR->value => "Đồ Thể Thao",
        ];

        return $statusTexts[$status] ?? "Unknown Status";
    }
}