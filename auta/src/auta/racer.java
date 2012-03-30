package auta;

import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.TextListener;



public class racer extends JFrame implements ActionListener{
	/**
	 * 
	 */
	private static final long serialVersionUID = -5882900244891307331L;
	private static JFrame fr=null;
	private static Panel p = null;
	private static boolean visible = true;
	private TextField[] t;
	private Label[] l;
	private static Button submit = null;
	private static int y_ = 40;
	private static Dimension d = new Dimension(480, 640);
	private static String[] credentials=null;
	

	public void new_racer(String name){
		
		JFrame.setDefaultLookAndFeelDecorated(true);
		fr = new JFrame("Racer add");
		
		p = new Panel();
		fr.setSize(d);
		
		menu();
		fr.add(p);
		fr.setVisible(visible);
		p.setVisible(true);
	}

	public void menu(){
		l = new Label[4];
		t = new TextField[4];
		l[0] = new Label("Jméno");	
		t[0] = new TextField(20);
		l[1] = new Label("Příjmení");
		t[1] = new TextField(20);
		l[2] = new Label("Kategorie");
		t[2] = new TextField(20);
		l[3] = new Label("Klub");
		t[3] = new TextField(20);
		for (int i = 0;i<=t.length-1;i++){
			
			p.add(l[i]);
			p.add(t[i]);
			l[i].setLocation(10,(y_*i));
			t[i].setLocation(100, (y_*i));
		}
		submit = new Button("Submit");
		submit.addActionListener(this);
		submit.setActionCommand("submit");
		p.add(submit);
		
	}
	
	public void actionPerformed(ActionEvent e){
		//Handling actions like evt.target == exit
		

			// TODO: code to handle submit 
			if(e.getActionCommand() == "submit"){
				try{
					credentials = new String[t.length];
				for(int i=0;i<=t.length-1;i++){
					credentials[i]=t[i].getText();
				}
				fr.setVisible(false);
				}
				catch (Exception f) {
					System.out.println(f.getMessage());
				}
			}

		
	}
	
	public String[] getCredentials(){
		return credentials;
	}
	
	
	public void submit(){
		
	}
	public static void main(String[] argv){
		racer a = new racer();
		a.new_racer(new String());
	}
	public void finalize(){
		
	}

}