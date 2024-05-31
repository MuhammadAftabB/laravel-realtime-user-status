use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserActivityLogsTable extends Migration
{
public function up()
{
Schema::create('user_activity_logs', function (Blueprint $table) {
$table->id();
$table->foreignId('user_id')->constrained()->onDelete('cascade');
$table->string('activity');
$table->timestamp('created_at')->useCurrent();
});
}

public function down()
{
Schema::dropIfExists('user_activity_logs');
}
}
