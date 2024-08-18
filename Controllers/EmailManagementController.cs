using System.Web.Mvc;
using System.Data.SqlClient;

namespace Email.Controllers
{
    public class EmailManagementController : Controller
    {
        [HttpPost]
        public JsonResult SubmitEmail(EmailModel model)
        {
            string connectionString = "Server=.;Database=TestDb;User Id=sa;Password=Saba1380;";

            using (SqlConnection conn = new SqlConnection(connectionString))
            {
                string query = "INSERT INTO Users (Name, Email,Subject,Message) VALUES (@Name, @Email,@Subject,@Message)";

                SqlCommand cmd = new SqlCommand(query, conn);
                cmd.Parameters.AddWithValue("@Name", model.Name);
                cmd.Parameters.AddWithValue("@Email", model.Email);
                cmd.Parameters.AddWithValue("@Subject", model.Email);
                cmd.Parameters.AddWithValue("@Message", model.Email);

                conn.Open();S
                int result = cmd.ExecuteNonQuery();
                
                if (result > 0)
                {
                    return Json("Record saved successfully!");
                }
                else
                {
                    return Json("Error while saving record!");
                }
            }
        }
    }

    public class EmailModel
    {
        public string Name { get; set; }
        public string Email { get; set; }
        public string Subject { get; set; }
        public string Message { get; set; }
    }
}
