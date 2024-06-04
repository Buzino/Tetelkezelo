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
using MySql.Data.MySqlClient;

namespace tételkezelő
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }
        private MySqlConnection ConnectToDatabase()
        {
            string connectionString = "server=localhost;user=root;password='';database='tetelkezelo'";
            return new MySqlConnection(connectionString);
        }
        private void LoadDataIntoDGV()
        {
            using (MySqlConnection conn = ConnectToDatabase())
            {
                try
                {
                    conn.Open();
                    string query = @"SELECT targyak.nev, tetelek.sorszam, tetelek.cim, tetelek.vazlat, tetelek.kidolgozas, tetelek.modositva FROM tetelek INNER JOIN targyak ON tetelek.tantargyid = targyak.id";

                    MySqlDataAdapter da = new MySqlDataAdapter(query, conn);
                    DataTable dt = new DataTable();
                    da.Fill(dt);

                    tetelekDGV.DataSource = dt;

                    tetelekDGV.AutoResizeColumn(0);
                    tetelekDGV.AutoResizeColumn(1);
                    tetelekDGV.AutoResizeColumn(2);
                    tetelekDGV.AutoResizeColumn(5);

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
        private void tetelekDGVchanged()
        {
            tetelekDGV.cell
        }
    }
}
