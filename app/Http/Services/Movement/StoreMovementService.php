<?php

namespace App\Http\Services\Movement;

use Illuminate\Http\{JsonResponse, Request};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Enums\MovementTypeEnum;
use App\Models\{ Movement, MovementDetail };
//use App\Http\Requests\Movement\StoreMovementRequest;

//https://stackoverflow.com/questions/46682530/validate-uuid-with-laravel-validation
// use Ramsey\Uuid\Uuid as UuidValidator; // No more needed here

class StoreMovementService
{
    static public function execute(Request $request, string $typeId): JsonResponse
    {
        // $uuidIsValid = UuidValidator::isValid($request->main["store_uuid"]); // No more needed here

        $dataMain = [
            'type_id' => $typeId,
            'date_time' => $request->main["date_time"],
            'subject' => $request->main["subject"],
            'description' => $request->main["description"],
            'observation' => $request->main["observation"],
            'support_type_id' => $request->main["support_type_id"],
            'support_number' => $request->main["support_number"],
            'support_date' => '2024-10-10T15:45:00.000Z', //$request->main["support_date"],
            // 'store_uuid' => $request->main["store_uuid"] // // No more needed here
        ];
        
        $validatorMain = Validator::make(
            data: $dataMain,
            rules: [
                'type_id' => [Rule::enum(MovementTypeEnum::class)],
                'date_time' => ['required', 'date'],
                'subject' => ['required', 'string'],
                'support_type_id' => ['required', 'string'],
                'support_number' => ['required', 'string'],
                'support_date' => ['required', 'date'],
            ]
        )->validate();
            
        $dataDetais = $request->details;
        $validatorDetails = Validator::make($dataDetais, [
            '*.id' =>  ['required', 'numeric'],
            '*.int_cod' => ['required', 'string'],
            '*.name' => ['required', 'string'],
            '*.quantity'  => ['required', 'numeric']
        ])->validate();

        $dataMainValidated = $validatorMain;
        $movement = new Movement;
        $movement->type_id = $dataMainValidated['type_id'];
        $movement->date_time =  $dataMainValidated['date_time'];
        $movement->subject =  $dataMainValidated['subject'];
        $movement->description = $request->main["description"];
        $movement->observation = $request->main["observation"];
        $movement->support_type_id = $dataMainValidated['support_type_id'];
        $movement->support_number = $dataMainValidated['support_number'];
        $movement->support_date = $dataMainValidated['support_date'];
        $movement->user_insert_id = Auth::user()->id;
        $movement->user_update_id = Auth::user()->id;
        // $movement->store_uuid = $request->main["store_uuid"];  // No more needed here

        $dataDetailsValidated = $validatorDetails;
        $movementDetail = [];
        for ($i = 0; $i < count($dataDetailsValidated); $i++) {
            $movementDetail[$i] = new MovementDetail;
            $movementDetail[$i]->article_id = $dataDetailsValidated[$i]['id'];
            $movementDetail[$i]->quantity = $dataDetailsValidated[$i]['quantity']; 
            $movementDetail[$i]->user_insert_id = Auth::user()->id;
            $movementDetail[$i]->user_update_id = Auth::user()->id;
        }

        DB::transaction(function () use($movement, $movementDetail) {
            $movement->save();
            for ($i = 0; $i < count($movementDetail); $i++) {
                $movementDetail[$i]->movement_id = $movement->id;
                $movementDetail[$i]->save();           
            } //throw new \App\Exceptions\CustomException('Error: Levi Strauss & CO.', 501);
            $movement->refresh();
        }, 5);

        return response()->json([
            "message" => "New record created successfully", 
            "id" => $movement->id,
            "number" => $movement->number
        ], 201);
    }

}

