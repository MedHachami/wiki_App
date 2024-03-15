<?php

class tes
{
    private $session_startAt = '2024-02-21T09:00:29.000000Z';
    private $session_endAt = '2024-02-27T09:00:29.000000Z';

    private function isDuplicatePair($pair, $generatedPairs)
    {
        return in_array($pair, $generatedPairs) || in_array(['evaluator' => $pair['evaluatee'], 'evaluatee' => $pair['evaluator']], $generatedPairs);
    }
    private function generatePairs($users, &$generatedPairs)
    {
        $pairs = [];

        foreach ($users as $pair1) {
            $remainingPairs = array_filter($users, function ($pair2) use ($pair1) {
                return $pair2['id'] !== $pair1['id'];
            });

            shuffle($remainingPairs);

            do {
                if (empty($remainingPairs)) {
                    break; // No available evaluatee, break the loop
                }

                $pair2 = array_pop($remainingPairs);
                $pair = ['evaluator' => $pair2, 'evaluatee' => $pair1];

                // Check for duplicate pair
                $isDuplicate = $this->isDuplicatePair($pair, $generatedPairs);

                // If duplicate, retry with a different evaluatee
            } while ($isDuplicate);

            // Add the pair to the generated pairs
            $generatedPairs[] = $pair;

            // Add the pair to pairs
            $pairs[] = $pair;
        }

        return $pairs;
    }
    private function scheduleRounds($rounds, $sessionStart, $sessionEnd, $roundDuration)
    {
        $scheduledRounds = [];

        $sessionStartTime = strtotime($sessionStart);
        $sessionEndTime = strtotime($sessionEnd);

        $roundStartTime = $sessionStartTime;

        foreach ($rounds as $round => $pairs) {
            $roundEndTime = $roundStartTime + $roundDuration;

            if ($roundEndTime > $sessionEndTime) {
                // Adjust if the round goes beyond the session end time
                $roundEndTime = $sessionEndTime;
            }

            $scheduledRounds[$round] = [
                'start' => date('Y-m-d H:i:s', $roundStartTime),
                'end' => date('Y-m-d H:i:s', $roundEndTime),
                'pairs' => $pairs,
            ];

            // Move to the next round start time
            $roundStartTime = $roundEndTime;
        }

        return $scheduledRounds;
    }
    public function createSession()
    {
        $users = [
            ['id' => 1, 'fullName' => 'John'],
            ['id' => 2, 'fullName' => 'Mahrez'],
            ['id' => 3, 'fullName' => 'Jack'],
            ['id' => 4, 'fullName' => 'naima'],
            ['id' => 5, 'fullName' => 'mamdo'],
            ['id' => 6, 'fullName' => 'doza'],
            ['id' => 7, 'fullName' => 'walido'],
            ['id' => 8, 'fullName' => 'alae'],
            ['id' => 9, 'fullName' => 'mamdo'],
            ['id' => 10, 'fullName' => 'doza'],
            ['id' => 11, 'fullName' => 'walido'],
            ['id' => 12, 'fullName' => 'alae'],
            // ['id' => 13, 'fullName' => 'walido'],
            // ['id' => 14, 'fullName' => 'alae'],
            // ['id' => 15, 'fullName' => 'mamdo'],
            // ['id' => 16, 'fullName' => 'doza'],
            // ['id' => 17, 'fullName' => 'walido'],
            // ['id' => 18, 'fullName' => 'alae'],

        ];

        $workingHours = [
            ['start' => '09:00', 'end' => '10:30'],
            ['start' => '10:45', 'end' => '12:30'],
            ['start' => '14:00', 'end' => '15:30'],
            ['start' => '15:45', 'end' => '17:30'],
        ];



        $evaluations = [];
        $generatedPairs = [];

        $evaluations = $this->generatePairs($users, $generatedPairs);




        // Shuffle the evaluations
        shuffle($evaluations);


        // $scheduler = new EvaluationScheduler();
        // $scheduledEvaluations = $scheduler->generateSchedule($evaluations, $this->session_startAt, $this->session_endAt);

        // Display the scheduled evaluations
        // foreach ($scheduledEvaluations as $evaluation) {
        //     echo "Evaluator: user" . $evaluation['evaluator']['id'] . ", Evaluatee: user" . $evaluation['evaluatee']['id'] . ", StartAt: " . $evaluation['startAt'] . ", EndAt: " . $evaluation['endAt'] . "<br />";
        // }
        foreach ($evaluations as $evaluation) {
            echo "Evaluator: user" . $evaluation['evaluator']['id'] . ", Evaluatee: user" . $evaluation['evaluatee']['id'] . "<br />";
        }
        // each round have a multiple pairs

        $firstEvaluator = $evaluations[0]['evaluator']['id'];
        $firstEvaluatee = $evaluations[0]['evaluatee']['id'];
        $rounds = [
            'round 1' => [
                ['evaluatorId' => $firstEvaluator, 'evaluateeId' => $firstEvaluatee],
            ],
        ];

        $numEvaluation = count($evaluations);

        for ($i = 1; $i < $numEvaluation; $i++) {
            $evaluator = $evaluations[$i]['evaluator']['id'];
            $evaluatee = $evaluations[$i]['evaluatee']['id'];

            $addedToRound = false;

            foreach ($rounds as $key => $round) {
                $usersInRound = array_merge(array_column($round, 'evaluatorId'), array_column($round, 'evaluateeId'));

                if (!in_array($evaluator, $usersInRound) && !in_array($evaluatee, $usersInRound)) {
                    $Evaluator = $evaluator;
                    $Evaluatee = $evaluatee;

                    $rounds[$key][] = ['evaluatorId' => $Evaluator, 'evaluateeId' => $Evaluatee];
                    $addedToRound = true;
                    break;
                }
            }

            if (!$addedToRound) {
                $Evaluator = $evaluator;
                $Evaluatee = $evaluatee;

                $rounds['round ' . (count($rounds) + 1)][] = ['evaluatorId' => $Evaluator, 'evaluateeId' => $Evaluatee];
            }
        }

        // Print the result
        foreach ($rounds as $round => $pairs) {
            echo $round . ": ";
            foreach ($pairs as $pair) {
                echo $pair['evaluatorId'] . "-" . $pair['evaluateeId'] . " ";
            }
            echo "<br>";
        }
        $sessionStart = $this->session_startAt;
        $sessionEnd = $this->session_endAt;
        $roundDuration = 60 * 60; // 60 minutes in seconds

        // Schedule the rounds
        $scheduledRounds = $this->scheduleRounds($rounds, $sessionStart, $sessionEnd, $roundDuration);

        // Display the scheduled rounds
        echo "Session: StartAt: " . $sessionStart . ", EndAt: " . $sessionEnd . "<br>";
        foreach ($scheduledRounds as $round => $schedule) {
            echo $round . ": ";
            foreach ($schedule['pairs'] as $pair) {
                echo $pair['evaluatorId'] . "-" . $pair['evaluateeId'] . " ";
            }
            echo "StartAt: " . $schedule['start'] . ", EndAt: " . $schedule['end'] . "<br>";
        }


    }
}
class Scheduler
{
    private $workingHours = [
        ['start' => '09:00', 'end' => '10:30'],
        ['start' => '10:45', 'end' => '12:30'],
        // Lunch break from 12:30 to 14:00
        ['start' => '14:00', 'end' => '15:30'],
        ['start' => '15:45', 'end' => '17:30'],
    ];

    private $session_startAt = '2024-02-21T09:00:29.000000Z';
    private $session_endAt = '2024-02-22T09:00:29.000000Z';

    public function scheduleRounds($rounds, $duration)
    {
        $startTime = strtotime($this->session_startAt);
        $endTime = strtotime($this->session_endAt);
        $roundDuration = $duration * 60; // Convert duration to seconds
        $i = 0;
        // print_r($round);
        // echo "<br />";

        $scheduledRounds = [];

        // [
        //     [ Round 1
        //         [[1,2],[3,4]]=>['startAt=>'','endAt=>'']]
        //     ],
        //     [
        //         []=>[]
        //     ],
        //     [
        //         []=>[]
        //     ]

        // ]

        while ($startTime <= $endTime) {
            $i++;

            foreach ($rounds as $round => $pairs) {
                echo $round;
            }



            // Move to the next day
            $startTime = strtotime('+1 day', $startTime);
            $startTime = strtotime(date('Y-m-d', $startTime) . ' 00:00:00');
        }


    }

    private function scheduleRound($round, $startTime, $duration)
    {
        $evaluatorId = $round['evaluator']['id'];
        $evaluateeId = $round['evaluatee']['id'];

        $startDateTime = date('Y-m-d H:i:s', $startTime);
        $endDateTime = date('Y-m-d H:i:s', $startTime + $duration);

        echo " {$evaluatorId}-{$evaluateeId} | Start: {$startDateTime} | End: {$endDateTime}<br>";
    }

    public function isDuringLunchBreak()
    {
        $roundStart = '2024-02-21 12:00:29';
        $roundEnd = '2024-02-21 13:00:29';
         $workingHours = [
            ['start' => '09:00', 'end' => '10:30'],
            ['start' => '10:45', 'end' => '12:30'],
            // Lunch break from 12:30 to 14:00
            ['start' => '14:00', 'end' => '15:30'],
            ['start' => '15:45', 'end' => '17:30'],
        ];
    

        foreach ($workingHours as $workingHour) {
            $startTime = strtotime($workingHour['start']);
            $endTime = strtotime($workingHour['end']);

            // Check if the round overlaps with the lunch break
            if ($roundStart < $endTime && $roundEnd > $startTime) {
                echo "nooo";
            }
        }

        echo "false";
    }
}

