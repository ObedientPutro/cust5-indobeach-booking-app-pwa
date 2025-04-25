<?php

namespace Database\Seeders;

use App\Enums\PostStatus;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::insert([
            [
                'category_id' => 1,
                'title' => 'gazebo type 1',
                'description' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc id ipsum at eros sodales viverra vel at est. Cras convallis lacinia odio vitae elementum. Ut mollis velit vel libero fringilla viverra. Praesent semper elit eu magna sollicitudin aliquet. Sed sagittis commodo ligula eget pellentesque. Fusce vitae nibh convallis, lobortis lectus non, pretium odio. Vestibulum viverra, odio eget condimentum rutrum, mi diam blandit orci, id lobortis augue augue vitae quam. Cras sagittis porttitor neque vitae semper. Nunc vel mauris luctus, venenatis nibh sit amet, interdum lectus. Aenean eu rutrum lacus. Pellentesque vulputate quis diam quis cursus. Fusce non augue vel est tempus porttitor at vel nisi. Proin et purus id dui auctor euismod. Maecenas cursus est lorem, vitae aliquam ipsum feugiat nec. \n\n Nam sit amet tortor nec erat eleifend facilisis. Nunc placerat quis lectus id sagittis. In efficitur libero quis tellus blandit suscipit. Suspendisse pulvinar, metus quis hendrerit dapibus, est mauris ullamcorper nunc, quis tristique est odio ac dui. Vestibulum felis sapien, egestas ac sodales quis, volutpat et leo. Nulla blandit, metus sed posuere rutrum, ante ipsum viverra felis, in auctor quam est tempus velit. Maecenas molestie lorem id elit congue fringilla. Nunc ut consectetur ipsum. Sed auctor feugiat semper. Vestibulum sit amet tellus eu eros tempor commodo at eget risus. Vivamus a lacinia neque. Phasellus at mattis augue. Cras fermentum ullamcorper finibus. Curabitur a mauris odio.",
                'price' => 500000,
                'quantity' => 5,
                'quantity_left' => 5,
                'status' => PostStatus::Published,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 1,
                'title' => 'gazebo type 2',
                'description' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc id ipsum at eros sodales viverra vel at est. Cras convallis lacinia odio vitae elementum. Ut mollis velit vel libero fringilla viverra. Praesent semper elit eu magna sollicitudin aliquet. Sed sagittis commodo ligula eget pellentesque. Fusce vitae nibh convallis, lobortis lectus non, pretium odio. Vestibulum viverra, odio eget condimentum rutrum, mi diam blandit orci, id lobortis augue augue vitae quam. Cras sagittis porttitor neque vitae semper. Nunc vel mauris luctus, venenatis nibh sit amet, interdum lectus. Aenean eu rutrum lacus. Pellentesque vulputate quis diam quis cursus. Fusce non augue vel est tempus porttitor at vel nisi. Proin et purus id dui auctor euismod. Maecenas cursus est lorem, vitae aliquam ipsum feugiat nec. \n\n Nam sit amet tortor nec erat eleifend facilisis. Nunc placerat quis lectus id sagittis. In efficitur libero quis tellus blandit suscipit. Suspendisse pulvinar, metus quis hendrerit dapibus, est mauris ullamcorper nunc, quis tristique est odio ac dui. Vestibulum felis sapien, egestas ac sodales quis, volutpat et leo. Nulla blandit, metus sed posuere rutrum, ante ipsum viverra felis, in auctor quam est tempus velit. Maecenas molestie lorem id elit congue fringilla. Nunc ut consectetur ipsum. Sed auctor feugiat semper. Vestibulum sit amet tellus eu eros tempor commodo at eget risus. Vivamus a lacinia neque. Phasellus at mattis augue. Cras fermentum ullamcorper finibus. Curabitur a mauris odio.",
                'price' => 400000,
                'quantity' => 7,
                'quantity_left' => 7,
                'status' => PostStatus::Published,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 2,
                'title' => 'cottage type 1',
                'description' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc id ipsum at eros sodales viverra vel at est. Cras convallis lacinia odio vitae elementum. Ut mollis velit vel libero fringilla viverra. Praesent semper elit eu magna sollicitudin aliquet. Sed sagittis commodo ligula eget pellentesque. Fusce vitae nibh convallis, lobortis lectus non, pretium odio. Vestibulum viverra, odio eget condimentum rutrum, mi diam blandit orci, id lobortis augue augue vitae quam. Cras sagittis porttitor neque vitae semper. Nunc vel mauris luctus, venenatis nibh sit amet, interdum lectus. Aenean eu rutrum lacus. Pellentesque vulputate quis diam quis cursus. Fusce non augue vel est tempus porttitor at vel nisi. Proin et purus id dui auctor euismod. Maecenas cursus est lorem, vitae aliquam ipsum feugiat nec. \n\n Nam sit amet tortor nec erat eleifend facilisis. Nunc placerat quis lectus id sagittis. In efficitur libero quis tellus blandit suscipit. Suspendisse pulvinar, metus quis hendrerit dapibus, est mauris ullamcorper nunc, quis tristique est odio ac dui. Vestibulum felis sapien, egestas ac sodales quis, volutpat et leo. Nulla blandit, metus sed posuere rutrum, ante ipsum viverra felis, in auctor quam est tempus velit. Maecenas molestie lorem id elit congue fringilla. Nunc ut consectetur ipsum. Sed auctor feugiat semper. Vestibulum sit amet tellus eu eros tempor commodo at eget risus. Vivamus a lacinia neque. Phasellus at mattis augue. Cras fermentum ullamcorper finibus. Curabitur a mauris odio.",
                'price' => 900000,
                'quantity' => 6,
                'quantity_left' => 6,
                'status' => PostStatus::Published,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
