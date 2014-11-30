package com.tum.foobank;

import java.security.NoSuchAlgorithmException;

/**
 *
 */
public class Test {

    public static void main(String[] args) {
        try {
        	System.out.print(TokenUtil.getCode("1234", "/var/www/html/foobank/securToken/data.txt"));
        } catch (NoSuchAlgorithmException e) {
            e.printStackTrace();
        } catch (Exception e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
    }

}
