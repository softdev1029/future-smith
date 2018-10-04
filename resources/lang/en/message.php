<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Message Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during display of a message for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'user' => [
        'registered' => 'Congratulations! your account is registered, you will shortly receive an email to activate your account.',
        'activate' => 'Your activation code is either expired or invalid.',
        'activated' => 'Congratulations! your account is now activated.',
        'forbidden' => 'You don\'t have enough right',
        'updated' => 'You have been updated your profile.',
        'membership' => [
            'created' => 'You have been created new subscription - :plan',
            'cancelled' => 'You have been cancelled your subscription - :plan',
            'resumed' => 'You have been resumed your subscription - :plan',
            'need' => 'You need to create a subscription.',
        ],
    ],
    'tribe' => [
        'created' => 'You have been created new tribe successfully.',
        'updated' => 'You have been updated tribe successfully.',
        'join' => 'You have sent the request to join this tribe.',
        'need_join' => 'You need to send joining request.',
        'max_join' => 'You cannot join more than :max tribes.',
        'max_create' => 'You cannot create more than :max tribes.',
        'accepted' => 'You have been accpeted to join a User - :user into your tribe.',
        'declined' => 'You have been declined to join a User - :user into your tribe.',
        'invited' => 'You have send the invitation to join this tribe.',
        'left' => 'You have left this tribe.',
        'max_project' => 'You cannot create a project, the maximum number of project in this tribe is :max.',
    ],
    'project' => [
        'created' => 'You have been created new project successfully.',
        'updated' => 'You have been updated project successfully.',
        'join' => 'You have sent the request to join this project.',
        'need_join' => 'You need to send joining request.',
        'accepted' => 'You have been accpeted to join a User - :user into your project.',
        'declined' => 'You have been declined to join a User - :user into your project.',
        'left' => 'You have left this project.',
    ],
    'discussion' => [
        'created' => 'You have been created new discussion successfully.',
        'updated' => 'You have been updated discussion successfully.',
        'forbidden' => 'You cannot post because you are not a member of this tribe.',
    ],

];
