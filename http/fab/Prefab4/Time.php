<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab4;

class Time implements TimeInterface
{
    protected $dateTimeZones = [];

    public function getNow(string $timezoneCode = self::DEFAULT_TIMEZONE_CODE): \DateTime
    {
        $microTime = explode('.', sprintf('%f', microtime(true)));
        $time = gmdate(self::MYSQL_DATE_TIME_FORMAT . '.' . $microTime[1], (int) $microTime[0]);
        $now = new \DateTime($time, new \DateTimeZone('GMT'));
        $now->setTimezone($this->getDateTimeZone($timezoneCode));

        return $now;
    }

    public function getUnixReferenceTimeNow(): string
    {
        return sprintf('%f', microtime(true));
    }

    public function validateTimestamp(string $timestamp, string $format = TimeInterface::MYSQL_DATE_TIME_FORMAT): bool
    {
        $dateTime = \DateTime::createFromFormat($format, $timestamp);

        return $dateTime && $dateTime->format($format) == $timestamp;
    }

    public function getDateTimeZone(string $timezoneCode = self::DEFAULT_TIMEZONE_CODE): \DateTimeZone
    {
        if (!isset($this->dateTimeZones[$timezoneCode])) {
            $dateTimeZone = new \DateTimeZone($timezoneCode);
            $this->dateTimeZones[$timezoneCode] = $dateTimeZone;
        }

        return clone $this->dateTimeZones[$timezoneCode];
    }

    public function getNewDateInterval(string $intervalSpec): \DateInterval
    {
        return new \DateInterval($intervalSpec);
    }
}
