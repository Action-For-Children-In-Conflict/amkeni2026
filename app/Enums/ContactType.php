<?php

namespace App\Enums;

enum ContactType: string
{
    case Contact = 'contact';
    case Volunteer = 'volunteer';
    case Partner = 'partner';

    public function label(): string
    {
        return match ($this) {
            self::Contact => 'Contact',
            self::Volunteer => 'Volunteer',
            self::Partner => 'Partnership',
        };
    }

    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $type): array => [$type->value => $type->label()])
            ->all();
    }
}
