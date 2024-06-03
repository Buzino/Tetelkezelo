using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.Data.SqlClient;

namespace tételkezelő
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }
        private SqlConnection ConnectToDatabase()
        {
            string connectionString = "server=localhost;user=root;password='';database='tetelkezelo'";
            return new SqlConnection(connectionString);
        }
        private void LoadDataIntoDGV()
        {
            using (SqlConnection conn = ConnectToDatabase())
            {
                try
                {
                    conn.Open();
                    string query = @"SELECT * FROM tetelek INNER JOIN targyak ON tetelek.tantargyid = targyak.id";

                    SqlDataAdapter da = new SqlDataAdapter(query, conn);
                    DataTable dt = new DataTable();
                    da.Fill(dt);

                    tetelekDGV.DataSource = dt;
                }
                catch (Exception ex)
                {
                    MessageBox.Show("Error loading data: " + ex.Message);
                }
            }
        }

        private void Form1_Load(object sender, EventArgs e)
        {
            LoadDataIntoDGV();
        }
    }
}
