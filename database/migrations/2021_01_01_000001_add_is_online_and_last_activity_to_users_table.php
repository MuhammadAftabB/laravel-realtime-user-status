use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsOnlineAndLastActivityToUsersTable extends Migration
{
public function up()
{
Schema::table('users', function (Blueprint $table) {
$table->boolean('is_online')->default(false);
$table->timestamp('last_activity')->nullable();
});
}

public function down()
{
Schema::table('users', function (Blueprint $table) {
$table->dropColumn(['is_online', 'last_activity']);
});
}
}
